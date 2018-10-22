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
        .container {
             padding-bottom: 70px;
         }
    }
    #g-recaptcha-response {
        display: block !important;
        position: absolute;
        margin: -78px 0 0 0 !important;
        width: 302px !important;
        height: 76px !important;
        z-index: -999999;
        opacity: 0;
    }

</style>
<br><br><br>
 <div class="container">

     <?php
     // grab recaptcha library
     require_once "recaptchalib.php";
     // your secret key
     $secret = "6Lc7UXYUAAAAAPWfhV4q0Tqjpc9XwPwOX5KLWVkB";
     // empty response
     $response = null;
     // check secret key
     $reCaptcha = new ReCaptcha($secret);



     if (isset($_POST["firstname"])){
         // if submitted check response
         if ($_POST["g-recaptcha-response"]) {
             $response = $reCaptcha->verifyResponse(
                 $_SERVER["REMOTE_ADDR"],
                 $_POST["g-recaptcha-response"]
             );

             echo "
                 MESSAGE SUBMITTED!<br><br>
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
            <input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"First name\" required>
        
            Last Name:
            <input type=\"text\" id=\"lastname\" name=\"lastname\" placeholder=\"Last name\" required>
        
            E-mail:
            <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"E-mail\" required>
        
            Subject:
            <textarea id=\"subject\" name=\"subject\" style=\"height:192px\" required></textarea>
            
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


     ?>


</div>

<br><br>

<?php
include_once ('layouts/footer.html');
?>