<?php

//Dit is de hash class hier staat alle functionaliteit die met hash te maken heeft
class Hash
{
    //Deze functie maak een nieuwe hash aan op basis van 2 opgegeven strings
    public static function make($string, $salt = '')
    {
        return hash('sha1', $string . $salt); //sha1 is een encrypty methode
    }

    //Deze functie genereert een random string die aan het wachtwoord toegevoegd om deze veiliger te maken
    public static function salt($length)
    {
        return bin2hex(random_bytes($length)); //deze functies maken een random string aan
    }

    //Deze functie maakt een unieke string aan op basis van de tijd in miliseconden 
    public static function unique()
    {
        return self::make(uniqid());
    }
}