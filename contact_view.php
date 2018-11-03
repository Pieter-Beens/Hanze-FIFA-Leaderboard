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
        max-width: 95%;
        width: auto;
        padding: 20px;
        margin: 0 auto;
        font-size: 24px;
        height: auto;
    }

     table {
         border: 1px solid white;
     }
     th {
         border: 1px solid white;
         border-top: 0px solid white;
     }

    tbody td{
        border-right: 1px solid white;
        font-size: 20px;
    }

    tbody tr:nth-child(odd){
        border-right: 1px solid white;
        background-color: rgba(67, 161, 255, 0.22);
        font-size: 20px;
    }

    tbody tr:nth-child(even){
        border-right: 1px solid white;
        background-color: rgba(198, 214, 255, 0.22);
        font-size: 20px;
    }

    .sButton{
        margin-top: -50px;
    }

    a {
        color: #aaffd9;
    }

    #table-container {
        min-width: 800px;
    }

    @media only screen and (max-width: 800px), (-moz-touch-enabled: 1), (pointer:coarse) {
        .sButton{
            width: 100%;
            margin-top: 16px;
        }
        input {
            font-size: 48px;
        }
        input[type=submit] {
            font-size: 48px;
         }
        .container {
             padding-bottom: 70px;
             width: 100%;
             max-width: 100%;
             font-size: 48px;
            overflow: scroll;
         }
    }

</style>
<br><br><br>
 <div class="container">

     <?php


     $user = new User;
     if ($user->isLoggedIn()) {
         if ($user->hasPermission('admin')) {

             $conn = DB::conn();
             $result = $conn->query("SELECT * FROM contact ORDER BY submit_date DESC");

             if ($result->num_rows <= 0) {
                 die("Database is leeg");
             }

             echo "<h3>Aantal contact formulieren: " . $result->num_rows . "</h3>";


             echo "
             <table id='table-container' style=\"width:100%\">
              <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>E-mail</th>
                <th>Subject</th>
                <th>Submit date</th>
                <th>Action</th>
              </tr>";


            if ($result->num_rows > 100) {
                $count = 100;
            } else {
                $count = $result->num_rows;
            }


            for ($i=0; $i<$count; $i++) {
                $row = mysqli_fetch_assoc($result);

                echo "<tr>
                <td>" . $row["firstname"] . "</td>
                <td>" . $row["lastname"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["subject"] . "</td>
                <td style='text-align: center'>" . date('[H:i:s] d-m-Y', $row["submit_date"]) . "</td>";

                    if ($row["closed"] == 1) {
                        echo "<td style='text-align: center'><a style='color: #00cb7f' href='respond.php?id=" . $row["ID"]. "'>" . "Read closed ticket" . "</a></td>";
                    } else {
                        echo "<td style='text-align: center'><a style='color: #ffd300' href='respond.php?id=" . $row["ID"]. "'>" . "Read & respond" . "</a></td>";
                    }
                echo "
                </tr>
                ";
            }
            echo "</table><br>";

















         } else {
             echo "No admin rights";
         }
     }
     /*// recaptcha library
     require_once "recaptchalib.php";
     // captcha secret key
     $secret = "6Lc7UXYUAAAAAPWfhV4q0Tqjpc9XwPwOX5KLWVkB";
     // response
     $response = null;
     // validate secret key
     $reCaptcha = new ReCaptcha($secret);

     if (isset($_POST["firstname"])){
         // if submitted check response
         if ($_POST["g-recaptcha-response"]) {
             $response = $reCaptcha->verifyResponse(
                 $_SERVER["REMOTE_ADDR"],
                 $_POST["g-recaptcha-response"]
             );

             // Result message
             $result = "MESSAGE SUBMITTED!";

             $tnow = time();
             // Submit message
             $query = "INSERT INTO contact ";
             $query .= "VALUES(NULL, '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '". $_POST["email"] . "', '" .  $_POST["subject_topic"] ."', '" .  $_POST["subject"] . "', $tnow)";
             mysqli_query($db, $query) or ($result = "ERROR: Can't Connect to database");

             mysqli_close($db);

             echo "
                 $result<br><br>
                 REDIRECTING IN <div id=\"rDSec\">8</div>
                 
                 <script>
                 function sleep(ms) {
                  return new Promise(resolve => setTimeout(resolve, ms));
                }
                
                async function startRedirect() {
                  for (var i = 7; i >0; i--){
                      await sleep(1000);
                      document.getElementById('rDSec').innerText = i;
                  }
                  window.location.replace(\"/FIFA-LEADERBOARD/leaderboard.php\");
                }
                startRedirect();
                </script>
            ";


         } else {
             echo "
                 reCAPTCHA HAS BEEN SKIPPED, MESSAGE HAS BEEN DROPPED!<br><br>
                 REDIRECTING IN <div id=\"rDSec\">30</div>
                 
                 <script>
                 function sleep(ms) {
                  return new Promise(resolve => setTimeout(resolve, ms));
                }
                
                async function startRedirect() {
                  for (var i = 29; i >0; i--){
                      await sleep(1000);
                      document.getElementById('rDSec').innerText = i;
                  }
                  window.location.replace(\"/FIFA-LEADERBOARD/leaderboard.php\");
                }
                startRedirect();
                </script>
            ";
         }

     } else {
         echo "
             <form method=\"post\" action=\"\">
        
            First Name:
            <input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"First name\" maxlength=\"80\" required>
        
            Last Name:
            <input type=\"text\" id=\"lastname\" name=\"lastname\" placeholder=\"Last name\" maxlength=\"80\" required>
        
            E-mail:
            <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"E-mail\" maxlength=\"150\" required>
        
            Subject title:
            <input type=\"text\" id=\"subject_topic\" name=\"subject_topic\" placeholder=\"Subject title\" maxlength=\"100\" required>
            
            Subject:
            <textarea id=\"subject\" name=\"subject\" style=\"height:192px\" maxlength=\"500\" required></textarea>
            
            <div class=\"g-recaptcha\" data-sitekey=\"6Lc7UXYUAAAAAOfs1OziuZBed-PJYAOYdpiTdrsQ\"></div>
            
            <input type=\"submit\" id=\"sbmtform\" class='sButton' value=\"Send\">
            
            </form>
            <script src='https://www.google.com/recaptcha/api.js'></script>
 
            <script>
            document.getElementById(\"sbmtform\").addEventListener(\"click\", function(event){
            if(grecaptcha.getResponse().length == 0){
                event.preventDefault();
	            alert('Please click the reCAPTCHA checkbox');
	        }
            }); 
            </script>
        ";
     }


     */
     ?>


</div>

<br><br>

<?php
    include_once ('layouts/footer.html');
?>