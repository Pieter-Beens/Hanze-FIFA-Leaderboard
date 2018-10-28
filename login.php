<?php
    require_once 'core/init.php';

    if (Input::exists()){
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
               'username' => array('required' => true),
               'password' => array('required' => true),
            ));

            if ($validation->passed()) {
                $user = new User();

                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

                if($login) {
                    Redirect::to('index.php');
                } else {
                    echo 'login failed';
                }
            } else {
                foreach ($validation->errors() as $error){
                    echo $error, '<br>';
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
    <title>Login</title>
</head>
<body>
<form action="" method="post">
    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"><br><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
    <label for="remember">
        <input type="checkbox" name="remember" id="remember"> Remember me
    </label>
    <hr>
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>