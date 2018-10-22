<title>Hanze FIFA Leaderboard</title>

<?php
session_start();
$title = "CONTACT";
include_once('layouts/header.php');
include_once('fifadbconn.php');


?>

<style>
    input[type=text], input[type=email], select, textarea {
        border: 2px solid rgba(0, 0, 0, 0.56);
        border-radius: 4px;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: rgba(0, 136, 175, 1);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        font-size: 20px;
    }

    input[type=submit]:hover {
        background-color: #2389a0;
    }

    .container {
        border-radius: 3px;
        background-color: rgba(0, 0, 0, 0.30);
        padding: 20px;
        max-width: 768px;
        margin: 0 auto;
        font-size: 24px;
    }
</style>
<br><br><br>
 <div class="container">

     <?php

     if (isset($_POST["firstname"])){
         echo "
             IK HOEFT NIET TE TANKEN SCHAT DAAAAAG
        ";
     } else {
         echo "
             <form method=\"post\" action=\"\">
        
            First Name:
            <input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"First name\" required>
        
            Last Name:
            <input type=\"text\" id=\"lastname\" name=\"lastname\" placeholder=\"Last name\" required>
        
            E-mail:
            <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"E-mail\" required>
        
            Subject:
            <textarea id=\"subject\" name=\"subject\" style=\"height:192px\" required></textarea>
        
            <input type=\"submit\" value=\"Send\">
              <br>
              <br>
        
            </form>
        ";
     }


     ?>


</div>

<br><br>

<?php
include_once ('layouts/footer.html');
?>