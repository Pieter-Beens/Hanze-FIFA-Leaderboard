<?php

//Dit is de redirect class hier staat alle functionaliteit die met redirect te maken heeft
class Redirect
{
    //Stuur de gebruiker naar een andere web pagina
    public static function to($location = null)
    {
        //Als location bestaat
        if ($location) {
            //Hier word gekeken of de aangegeven pagina een error pagina is
            if (is_numeric($location)) {
                switch ($location) {
                    //Als 404 is megegeven wordt er een error 404 pagina weergegeven
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'includes/errors/404.php';
                        exit();
                        break;
                }
            }
            //Als de pagina geen error is word de user naar de aangegeven pagina gestuurd
            header('Location: ' . $location);
            exit();
        }
    }
}