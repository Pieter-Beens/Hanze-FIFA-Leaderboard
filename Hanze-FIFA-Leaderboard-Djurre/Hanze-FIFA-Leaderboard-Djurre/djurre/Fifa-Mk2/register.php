<?php
    require_once 'core/init.php';

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 3,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                'cpassword' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'password'
                ),
                'name' => array(
                    'required' => true,
                    'min' => 3,
                    'max' => 50,
                ),
            ));

            if ($validation->passed()) {
                $user = new User();

                $salt = Hash::salt(32);

                try {
                    $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'permission' => 1,
                    ));

                    Session::flash('home', 'You have been registered');
                    Redirect::to('index.php');
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } else {
                foreach ($validation->errors() as $error){
                    echo $error .'<br>';
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
    <title>Registreer</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"><br>
        <input type="password" name="password"><br>
        <input type="password" name="cpassword"><br>
        <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>">
        <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
        <hr>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>