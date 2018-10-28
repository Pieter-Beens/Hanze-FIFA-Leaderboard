<?php

//Dit is de cookie class hier staat alle functionaliteit die met cookies te maken heeft
class Cookie
{
    //Deze functie kijk of de cookie bestaat
    public static function exists($name)
    {
        //De functie neemt de opgegeven naam en kijk of de cookie is gezet en geeft volgens true of false
        return (isset($_COOKIE[$name])) ? true : false; // ? = IF, : = ELSE
    }

    //Deze functie haal de cookie met de opgegeven naam op
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    //Deze fuctie maakt een nieuwe cookie aan met de opgegeven waardes
    public static function put($name, $value, $expiry)
    {
        //Hier kijkt de functie of de cookie aangemaakt is en geeft true of false trug
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    //Deze functie verwijdert de cookie met de opgegeven naam
    //Dit doet hij door de cookie opnieuw aan te maken met -1 tijd waardoor hij meteen verwijdert word
    public static function delete($name)
    {
        self::put($name, '', time() - 1); //self:: roept deze class aan e.g. cookie
    }
}