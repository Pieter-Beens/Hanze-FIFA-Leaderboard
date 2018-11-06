<html>
 <head>
   <?php include('layouts/header.php'); ?>
     <style>
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
             float:right;
             border-radius: 4px;
         }

         input[type=submit]:hover {
             /*background-color: #2389a0;*/
             color: purple;
             border: solid 1px purple;
             background-color: white;
         }
         input[type=text], input[type=email], select, textarea {
             border: 2px solid rgba(0, 0, 0, 0.56);
             border-radius: 4px;
             padding: 10px;
             box-sizing: border-box;
             margin-top: 6px;
             margin-bottom: 16px;
             resize: vertical;
         }
         .center-wrapper{
            width: 50%;
             min-width: 512px;
             margin: 0 auto;
             background-color: rgba(221, 221, 221, 0.15);
             padding: 20px;
             border-radius: 2px;
             border-style: dashed;
         }
     </style>
 </head>
<body>
<br>
<br>
<div class="center-wrapper">
    <div action = "resultaatmatch.php" method = "post">
        <h2>Vul de ID van de home player in:</h2> <input type="text" name = "players"><br>
    <input type = "submit">
    </form>
</div>
</body>
</html>
