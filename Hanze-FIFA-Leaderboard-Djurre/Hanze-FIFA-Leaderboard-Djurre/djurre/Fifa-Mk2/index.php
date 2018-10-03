<?php
    require_once 'core/init.php';

    if (Session::exists('home')) {
        echo Session::flash('home');
    }

    $user = new User;
    if ($user->isLoggedIn()){
        ?>
            <p>Hello <a href="#"><?php echo escape($user->data()->username);?></a></p>

            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="update.php">Update</a></li>
                <li><a href="changepassword.php">Change password</a></li>
                <li><a href="#"></a></li>
            </ul>
        <?php

        if ($user->hasPermission('admin')) {
            echo 'admin user';
        }

    } else {
        echo '<p><a href="login.php">Login</a> or <a href="register.php">Register</a></p>';
    }
