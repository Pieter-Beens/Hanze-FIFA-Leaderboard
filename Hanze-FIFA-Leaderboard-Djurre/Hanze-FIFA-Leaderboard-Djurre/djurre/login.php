<?php
$msg = '';

if (isset($_POST['submit'])){
    $con =  new mysqli('localhost', 'd_aikema_nl_fifa', 'Fifapass123', 'd_aikema_nl_fifa');

    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    if($email == "" || $password == ""){
        $msg = "Een veld is niet juist ingevuld";
    } else {
        $sql = $con->query("SELECT id,password,confirmation FROM users WHERE email='$email'");
        if($sql->num_rows > 0) {
            $data = $sql->fetch_array();
            if(password_verify($password, $data['password'])){
                if($data['confirmation'] == 0) {
                    $msg = "Email is niet geverifieerd";
                } else {
                    $msg = "Je bent ingelogged";
                }
            } else {
                $msg = "Een veld is niet juist ingevuld";
            }
        } else {
            $msg = "Een veld is niet juist ingevuld";
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Login</title>
</head>
<body>
<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <?php if ($msg != "") echo $msg ."<br><br>" ?>

            <form method="post" action="login.php">
                <input class="form-control" name="email" type="email" placeholder="E-mailadres"><br>
                <input class="form-control" name="password" type="password" placeholder="Wachtwoord"><br>
                <hr>
                <input class="btn btn-primary" type="submit" name="submit" value="Log In">
            </form>
        </div>
    </div>
</div>
</body>
</html>