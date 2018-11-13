<title>Hanze FIFA Leaderboard - Award Card Form</title>

<?php

// PAGE SETUP

$title = "AWARD CARDS";
include('layouts/header.php');
require_once 'core/init.php';
include('fifadbconn.php');

// QUERY for dropdown selection of accused:
$query = "SELECT `name`,`id`";
$query .= "FROM `users` ORDER BY `name` ASC";
$result = mysqli_query($db,$query) or die ('Error querying database');

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="DennisGlobalCSSFIXER.css">
    <style>
    @media only screen and (max-width: 800px), (-moz-touch-enabled: 1), (pointer:coarse) {
        *{
            font-size: 40px;
        }
        input[type=text], input[type=email], select, textarea {
            border: 2px solid rgba(0, 0, 0, 0.56);
            border-radius: 4px;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            font-size: 20px !important;
            font-family:FIFA16;
        }
    }

    tbody{
        width:100%;
    }
    </style>

</head>
<body>
<br>
<br>
<div class="center-wrapper" style="min-width: 600px;">
<form action="card_confirm.php" method="POST"><br>
The player you accuse of foul play:<br>
  <select name='accused' <?php if (isset($_POST['accused'])) echo "value=".$_POST['accused']; ?>>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['name'] != escape($user->data()->name)) {
        echo "<option value=";
        echo $row['id'];
        echo ">";
        echo $row['name'];
        echo "</option>";
      };
    }
    ?>
  </select><br>
  Your complaint: <i>(max length: 400 characters)</i><br><textarea maxlength=400 style=width:500px;height:200px name="description"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea>
  <br>
  <input style=height:40px type="submit" value="So help me god"><br>
</form>
</div><br>
</body>
</html>
