<?php

//Dit is de input class hier staat alle functionaliteit die met input te maken heeft
class Input
{
    //Deze functie kijkt of er een post gemaakt is
    //Hij stuurt vervolgens de opgevangen gegevens op en returned deze
    public static function exists($type = 'post')
    {
        switch ($type) {
            //Kijkt of er een post request gemaakt is en returned true of false
            case 'post':
                return (!empty($_POST)) ? true : false; // ? = IF, : = ELSE
                break;
            //Kijkt of er een get request gemaakt is en returned true of false
            case 'get':
                return (!empty($_GET)) ? true : false; // ? = IF, : = ELSE
                break;
            //Als het geen post of get is word false trug gestuurd
            default:
                return false;
                break;
        }
    }

    //Deze fuctie haalt de value uit de post/get
    public static function get($item)
    {
        //Als het een post request is word de value er uit gehaald en trug gestuurd
        if (isset($_POST[$item])) {
            return $_POST[$item];
            //Als het een get request is word de value er uit gehaald en trug gestuurd
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        //Als het geen post/get is word een lege string terug gestuurd
        return '';
    }
}