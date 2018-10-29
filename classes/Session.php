<?php

//Dit is de session class hier staat alle functionaliteit die met sessions te maken heeft
class Session
{
    //Session::exists, in deze function geef je de naam van een sessie op vervolgens checkt hij of deze bestaat
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    //Session::put, deze functie maakt een sessie met de aangegeven naam en waardes
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    //Session::get, haalt de sessie met de opgegeven naam op en returend deze
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    //Session::delete, deze functie kijkt of de sessie met de opgegeven naam bestaat. Als deze bestaat wordt hij verwijdert
    public static function delete($name)
    {
        //De functie gebruikt hier de Session::exists functie om te kijken of de sessie bestaat
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    //Session::flash, met deze functie kun je een sessie gebruiken om berichten mee te sturen tussen paginas
    public static function flash($name, $string = '')
    {
        //Als de sessie al bestaat word deze overschreven
        //Als de sessie niet bestaat word een nieuwe sessie met de aangegeven naam en string gemaakt
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }
}
