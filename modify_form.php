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
        /*background-color: rgba(0, 136, 175, 1);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;*/
        font-size: 20px;
        color: white;
        border: solid 1px purple;
        padding: 8px;
        background-color: transparent;
    }

    input[type=submit]:hover {
        /*background-color: #2389a0;*/
        color: purple;
        border: solid 1px purple;
        padding: 8px;
        background-color: white;
    }

    .container {
        border-radius: 3px;
        background-color: rgba(0, 0, 0, 0.30);
        max-width: 768px;
        padding: 20px;
        margin: 0 auto;
        font-size: 24px;
        height: auto;
    }


    .sButton{
        margin-top: -50px;
    }
    @media only screen and (max-width: 800px), (-moz-touch-enabled: 1), (pointer:coarse) {
        .sButton{
            width: 100%;
            margin-top: 16px;
        }
        input {
            font-size: 76px;
        }
        input[type=submit] {
            font-size: 76px;
         }
        .container {
             padding-bottom: 70px;
             width: 100%;
             max-width: 100%;
             font-size: 76px;
         }
    }

    th, td {
        border-bottom: 1px solid white;
        font-size: 22px;
    }
    .update-form{
        color: white;
        border: solid 1px purple;
        padding: 8px;
    }
    .update-form:hover{
        color: purple;
        border: solid 1px purple;
        padding: 8px;
        background-color: white;
    }

</style>
<br><br><br>
 <div class="container">

     <?php
     echo "Contact message id: " . $_GET["id"] . "<br><br>";



     $user = new User;
     if ($user->isLoggedIn() && $user->hasPermission('admin')) {

         $conn = DB::conn();

         if (isset($_POST['switch_ticket_state']) && $_POST['switch_ticket_state'] == "switch_ticket_state"){
             unset($_POST['switch_ticket_state']);

             // check state
             $query = "SELECT closed ";
             $query .= "FROM contact WHERE ID=". $_GET["id"];
             $result = $conn->query($query);
             $row = mysqli_fetch_assoc($result);

             // set state
             $query = "UPDATE contact ";
             if ($row['closed'] == 1) {
                 $query .= "SET closed=0 WHERE ID=" . $_GET["id"];
             } else {
                 $query .= "SET closed=1 WHERE ID=" . $_GET["id"];
             }
             $result = $conn->query($query);
         }

         $result = $conn->query("SELECT * FROM contact WHERE ID=". $_GET["id"] ." ORDER BY submit_date DESC");

         /*if ($result->num_rows <= 0) {
             die("Database is leeg");
         }*/

         $row = mysqli_fetch_assoc($result);

         if ($row["closed"] == 1) {
             $ticketDiv = "style=\"color: #00cb7f; border-top: solid 1px white !important;\"><br>This ticket has been closed";
         } else {
             $ticketDiv = "style=\"color: #ffd300; border-top: solid 1px white !important;\"><br>This ticket is not solved yet";
         }

         echo "
         <table>
         <tr>
            <td><div style='color: #b7ff99;'>Subject:</div> " . $row["subject"] . "</td>
         </tr>
         <tr>
            <td><div style='color: #b7ff99;'>Message:</div> " . $row["message"] . "
            
            </td>
         </tr>
         
         <tr>
            
            
            
            
            
         </tr>
         
         <tr>
            <td style='border-bottom: solid 0px white !important;'>
            
            <br><br><div style='color: #b7ff99;'>Note:</div> 
            <textarea id=\"message\" name=\"message\" style=\"height:192px\" maxlength=\"500\">".$row["note"]. "</textarea>
            
            </td>
         </tr>
         
         <!-- save changes-->
         <tr><td style='float:right; border-bottom: solid 0px white !important;'><div style='color: #b7ff99;'><br>
         <a class='update-form' href='respond.php?id=" . $row["ID"]. "'>" . "Save changes & return" . "</a><br><br>
         </td></tr>
         
         
         <tr>
            <td $ticketDiv
            
            <form method=\"post\" action=\"\">
            <!-- close ticket or reopen-->
            <input type='hidden' id='switch_ticket_state' name='switch_ticket_state' value='switch_ticket_state'>
            
         
         <input type=\"submit\" class='update-form' style='float:right; margin-bottom: 8px'  value=\"Switch ticket state\">
            </form>
            </td>
         </tr>
         
         
         
         </table>
         ";
         /*
          * <a type='submit' style='float:right; margin-bottom: 8px' class='update-form' href='modify_form.php?id=" . $row["ID"]. "'>" . "Reopen ticket" . "</a>
          * */



         
     } else {
        echo "You don't have permission to access this page";
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
             $query .= "VALUES(NULL, '" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '". $_POST["email"] . "', '" .  $_POST["subject"] ."', '" .  $_POST["message"] . "', $tnow)";
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
                  window.location.replace(\"/leaderboard.php\");
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
                  window.location.replace(\"/leaderboard.php\");
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
        
            Subject:
            <input type=\"text\" id=\"subject\" name=\"subject\" placeholder=\"Subject\" maxlength=\"100\" required>
            
            Message:
            <textarea id=\"message\" name=\"message\" style=\"height:192px\" maxlength=\"500\" required></textarea>
            
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