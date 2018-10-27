<?php

//Dit is de User class hier staat alle functionaliteit die met redirect te maken heeft
class User
{
    //Hier worden een aantal globale variabelen aangegeven die binnen de class gebruikt worden
    private $_db,
        $_data,
        $_isLoggedIn;

    //Deze functie word automatisch uitgevoerd wanneer de class word aangeroepen
    public function __construct($user = null)
    {
        //Hier word verbinding met de database gemaakt
        $this->_db = DB::conn();

        //Als de user niet bestaat
        if (!$user) {
            //Als session user wel bestaat word de user uit de sessie gehaald
            if (Session::exists('user')) {
                $user = Session::get('user');

                //de user word uit de sessie gehehaald en daarna in de database opgezocht
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    self::logout();
                }
            }
        } else {
            $this->find($user);
        }
    }

    //User::update, deze functie update een user op basis van de megegeven values
    public function update($fields = array(), $id = null)
    {
        //User id word opgehaald wanner deze niet megegeven is. De id word uit de ingelogde user gehaald
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        $set = '';
        $x = 1;
        //Hier worden de array values die zijn megegeven opgesplitst en in een query gezet
        foreach ($fields as $name => $value) {
            $set .= $name . "='" . $value . "'";
            if ($x < count($fields)) {
                $set .= ', ';
                $x++;
            }
        }

        //Hier word de update query uitgevoerd om de user te updaten in de database
        if (!$this->_db->query("UPDATE users SET " . $set . " WHERE id='$id'")) {
            throw new Exception('There was a problem updating');
        }
    }

    //User::create, hier word een nieuwe user in de database gezet
    public function create($fields = array())
    {
        $values = '';
        $x = 1;
        //De megegeven array word hier opgesplits en in een querry gezet
        foreach ($fields as $field) {
            $values .= "'" . $field . "'";
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        //De querry word hier uigevoerd en de user word in de database gezet
        if (!$this->_db->query("INSERT INTO users (name, password, salt, realname, email, confirmation, roles_id, joindate) VALUES (" . $values . ")")) {
            throw new Exception('There was a problem creating an account');
        }
    }

    //User::find, deze functie haalt een speciefieke user uit de database. Dit kan op id of username
    public function find($user = null)
    {
        if ($user) {
            //Kijkt of de value een nummer is, als het een nummer is zoek hij op id anders op username
            $field = (is_numeric($user)) ? 'id' : 'name';
            //Hier word de query uitgevoerd om de user uit de database te halen
            $data = $this->_db->query("SELECT * FROM users WHERE " . $field . "='$user'");

            //Als er meer dan 0 resultaten zijn word de variable _data het msqli object van user opgeslagen
            if ($data->num_rows > 0) {
                $this->_data = $data->fetch_object();
                return true;
            }
        }
        return false;
    }

    //User::login, deze functie logt de user in
    public function login($username = null, $password = null, $remember = false)
    {
        //Als het username en wachtwoord niet opgegeven zijn maar er is al een user in de _data variable opgeslagen word deze user in de sessie gezet
        if (!$username && !$password && $this->exists()) {
            Session::put('user', $this->data()->id);
        } else {
            //Als de username wel is ingevuld word de user uit de database gehaald met de find functie uit deze class
            $user = $this->find($username);
            //Als de user in de database is gevonden
            if ($user) {
                //Hier word het opgegeven wachtwoord gehashed en vergeleken met met wachtwoord in de database
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    //Als het wachtwoord en username overeen komen word de user in de sessie gezet
                    Session::put('user', $this->data()->id);

                    //Als de user heeft gekozen bij het inloggen om onthouden te worden
                    if ($remember) {
                        //Er word voor de user een unieke hash gemaakt
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->query("SELECT * FROM user_sessions WHERE user_id='" . $this->data()->id . "'");

                        //er word gekeken of de user in de database al een unieke hash heeft
                        //Wanneer dit niet het geval is worde een nieuwe aangemaakt en opgeslagen
                        //Als de user nu de pagina sluit en weer opent en de hash in de cookie komt overeen met die in de database dan word
                        //de user automatisch ingelogged
                        if ($hashCheck->num_rows <= 0) {
                            $this->_db->query("INSERT INTO user_sessions (user_id, hash) VALUES ('" . $this->data()->id . "', '$hash')");
                        } else {
                            $value = $hashCheck->fetch_array();
                            $hash = $value['hash'];
                        }

                        //Hier word de cookie gemaakt wanner de user onthouden wil worden
                        Cookie::put('hash', $hash, 604800);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    //User::hasPermission, deze functie is om te bepalen of de gebruiker de juiste rechten heeft
    public function hasPermission($key)
    {
        //Hier worden de rechten van de user uit de database gehaald
        $group = $this->_db->query("SELECT * FROM roles WHERE id='" . $this->data()->roles_id . "'")->fetch_object();

        //Als de user rechten heeft word hier gekeken of deze overeen komen met de rechten die gevraag worden in de $key variable
        if ($group) {
            $permissions = json_decode($group->name, true);

            print_r($permissions);
            if ($permissions[$key] == true) {
                return true;
            }
        }
        return false;
    }

    //User::exists, deze functie kijkt of de user bestaat in de variable
    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    //User::logout, deze functie logt de user uit
    public function logout()
    {
        $this->_db->query("DELETE FROM user_sessions WHERE user_id='" . $this->data()->id . "'");

        //De user sessie word hier opgeheven den de cookie word zowel uit de browser als de database verwijdert
        Session::delete('user');
        Cookie::delete('hash');
    }

    //User::data, met deze functie is het makkelijker im de data uit de _data variable te halen
    //De _data variable krijgt in een andere functie een waarde
    public function data()
    {
        return $this->_data;
    }

    //User::isLoggedIn, met deze funcite is het makkelijker om de data uit de _isLoggedIn variable te halen
    //De _isLoggedIn variable krijgt in een andere functie een waarde
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}