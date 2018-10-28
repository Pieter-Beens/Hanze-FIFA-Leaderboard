<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $msg = '';

    if (isset($_POST['submit'])){
        $con =  new mysqli('localhost', 'd_aikema_nl_fifa', 'Fifapass123', 'd_aikema_nl_fifa');

        $name = $con->real_escape_string($_POST['name']);
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        $cpassword = $con->real_escape_string($_POST['cpassword']);

        if($name == "" || $email == "" || $password != $cpassword){
            $msg = "Een veld is niet juist ingevuld";
        } else {
            $sql = $con->query("SELECT id FROM users WHERE email='$email'");
            if($sql->num_rows > 0) {
                $msg = "Dit email is al in gebruik";
            } else {
                $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM!$/()*';
                $token = str_shuffle($token);
                $token = substr($token, 0, 10);

                $hashed = password_hash($password, PASSWORD_BCRYPT);

                require 'PHPMailer/PHPMailer.php';
                $mail = new PHPMailer;
                $mail->setFrom('admin@d-aikema.nl', 'Admin');
                $mail->addAddress($email, $name);
                $mail->Subject  = 'Email verificatie';
                $mail->isHTML(true);
                $mail->Body = "<a href='http://fifa.d-aikema.nl/confirm.php?email=$email&token=$token'>Klik op deze link om uw email te verifiëren</a>";
                if(!$mail->send()) {
                    echo 'Message was not sent.';
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent.';
                    $con->query("INSERT INTO users (name,email,password,confirmation,token) VALUES ('$name', '$email', '$hashed', '0', '$token'); ");
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Registreer</title>
</head>
<body>
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <?php if ($msg != "") echo $msg ."<br><br>" ?>

                <form method="post" action="register.php">
                    <input class="form-control" name="name" placeholder="Naam"><br>
                    <input class="form-control" name="email" type="email" placeholder="E-mailadres"><br>
                    <input class="form-control" name="password" type="password" placeholder="Wachtwoord"><br>
                    <input class="form-control" name="cpassword" type="password" placeholder="Herhaal wachtwoord">
                    <hr>
                    <input class="btn btn-primary" type="submit" name="submit" value="Registreer">
                </form>
            </div>
        </div>
    </div>
</body>
</html>