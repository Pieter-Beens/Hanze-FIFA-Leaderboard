<?php
    require_once 'core/init.php';

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'name' => array(
                    'required' => true,
                    'min' => 3,
                    'max' => 14,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                'cpassword' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'password'
                ),
                'realname' => array(
                    'required' => true,
                    'min' => 3,
                    'max' => 50,
                ),
                'email' => array(
                    'required' => true,
                    'min' => 3,
                    'unique' => 'users',
                    'contains' => '@st.hanze.nl',
                ),
            ));

            if ($validation->passed()) {
                $user = new User();

                $salt = Hash::salt(32);

                try {
                    $user->create(array(
                        'name' => Input::get('name'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'score' => 100,
                        'highscore' => 100,
                        'realname' => Input::get('realname'),
                        'email' => Input::get('email'),
                        'confirmation' => 0,
                        'roles_id' => 1,
                        'joindate' => date("Y-m-d H:i:s"),
                    ));

                    Session::flash('home', 'You have been registered');
                    Redirect::to('index.php');
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                foreach ($validation->errors() as $error){
                    echo $error .'<br>';
                }
            }
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreer</title>
        <link rel="stylesheet" type="text/css" href="layouts/style.css">
</head>
<style>
  input{
    width: 100%;
    margin-top: 5%;
  }
  .register{
     width:25%;
     margin: 90px auto;
     background-color: rgba(0, 0, 0, 0.50);
     padding: 20px;
     border-radius: 15px;
     min-height: 200px;
     min-width: 200px;
  }
</style>
<body>
  <div class="register">
    <form action="" method="post">
        <label for="name">Username</label><br>
        <input type="text" id="name" name="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off"><br><br>

        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="cpassword">Repeat password</label><br>
        <input type="password" id="cpassword" name="cpassword"><br><br>

        <label for="realname">Name</label><br>
        <input type="text" id="realname" name="realname" value="<?php echo escape(Input::get('realname')); ?>"><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="<?php echo escape(Input::get('email')); ?>"><br><br>

        <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
        <hr>
        <input style="height:30px;width:60px;"type="submit" name="submit" value="submit">
    </form>
</body>
</html>
