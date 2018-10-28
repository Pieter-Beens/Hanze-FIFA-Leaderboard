<?php
    session_start();

    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'dbname' => 'fifa-project'
        ),
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 604800
        ),
        'session' => array(
            'session_name' => 'user'
        ),
    );

    spl_autoload_register(function($class){
        require_once 'classes/' . $class . '.php';
    });

    require_once 'functions/sanitize.php';

    if (Cookie::exists('hash') && !Session::exists('user')) {
        $hash = Cookie::get('hash');

        $conn = DB::conn();
        $hashCheck = $conn->query("SELECT * FROM user_sessions WHERE hash='$hash'");

        if ($hashCheck->num_rows > 0) {
            $hashCheck = $hashCheck->fetch_object();
            $user = new User($hashCheck->user_id);
            $user->login();
        }
    }