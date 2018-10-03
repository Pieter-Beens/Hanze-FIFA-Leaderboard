<?php
    function redirect() {
        header('Location: register.php');
        exit();
    }

    if (!isset($_GET['email']) || !isset($_GET['token'])){
        redirect();
    } else {
        $con =  new mysqli('localhost', 'd_aikema_nl_fifa', 'Fifapass123', 'd_aikema_nl_fifa');

        $email = $con->real_escape_string($_GET['email']);
        $token = $con->real_escape_string($_GET['token']);

        $sql = $con->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND confirmation=0");

        if ($sql->num_rows > 0){
            $con->query("UPDATE users SET confirmation=1, token='' WHERE email='$email'");
            header('Location: login.php');
        } else {
            redirect();
        }
    }