<?php

//Dit is de Token class hier staat alle functionaliteit die met redirect te maken heeft
class Token
{
    //Token::generate, deze functie genereert een nieuwe token
    public static function generate()
    {
        //De functie maakt een hash met md5 en zet deze in een sessie
        return Session::put('csrf', md5(uniqid()));
    }

    //Token::check, deze functie checkt of de csrf token bestaat
    public static function check($token)
    {
        $tokenName = 'csrf';

        //Als de csrf en de token overeen komen word true terug gestuurd
        //Csrf staat voor cross site request forgerie
        //Door het gebruiken van deze token voorkomen we dat mensen via de url data naar ons kunnen sturen
        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}