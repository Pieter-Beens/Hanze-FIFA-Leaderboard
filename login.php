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
                echo "$login";
                if($login) {
                    echo "About to redirect...";
                    header('Location: leaderboard.php');
                } else {
                    $err = 'Login failed';
                }
            }/* else {
                foreach ($validation->errors() as $error){
                    showError($error);
                }
            }*/
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
        <link rel="stylesheet" type="text/css" href="layouts/style.css">
</head>
<style>
  body{
      color: #383838;
  }
    input{
    width: 100%;
    margin-top: 5%;
  }
  .login{
     width:25%;
     margin: 90px auto;
      background-color: rgba(234, 234, 234, 0.91);
     padding: 20px;
     border-radius: 2px;
      border-style: dashed;
     min-width: 256px;
	 height: auto;
  }
  input[type=submit] {
      /*background-color: rgba(0, 136, 175, 1);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;*/
      font-size: 16px;
      color: white;
      border: solid 1px purple;
      padding: 8px;
      background-color: purple;
      padding-bottom: 24px;
      float:right;
  }

  input[type=submit]:hover {
      /*background-color: #2389a0;*/
      color: purple;
      border: solid 1px purple;
      background-color: white;
  }
</style>
<body>
<div class="login">
<form action="" method="post">
    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"><br><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
    <label for="remember"></label><br>
    <input style="width: auto;" type="checkbox" name="remember" id="remember">Remember me
    <input style="height:30px;width:60px;"type="submit" name="submit" value="Login">
</form>
    <?php
    if (isset($validation) && $validation->passed() == false) {
        foreach ($validation->errors() as $error){
            echo "$error<br>";
        }
    }
    if (isset($err)) {
        echo "$err<br>";
    }

    ?>
</div>
</body>
</html>
