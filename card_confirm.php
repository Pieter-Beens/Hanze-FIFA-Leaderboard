<link rel="stylesheet" type="text/css" href="DennisGlobalCSSFIXER.css">
<?php

// PAGE SETUP

$title = "ADD RESULTS";
include('layouts/header.php');
require_once 'core/init.php';
include('fifadbconn.php');
echo "<br><br><div class=\"center-wrapper\" style=\"width: 512px;\">";

if (!isset($_POST['accused']) AND !isset($_SESSION['accused'])) die('Session data has been lost.');

if (isset($_POST['accused'])) $_SESSION['accused'] = $_POST['accused'];
if (isset($_POST['description'])) $_SESSION['description'] = $_POST['description'];

$query = "SELECT `id` FROM cards WHERE accuser = ".escape($user->data()->id)." AND accused = ".$_SESSION['accused'];
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result) > 0) {
  echo "<p style=color:red>You have booked this player before. You may continue to add this card, but note that it will overwrite your previous one. One player cannot award two cards to the same player.</p>";
  $duplicate = TRUE;
  $existingcard = mysqli_fetch_assoc($result);
}

$query = "SELECT `name` FROM `users` WHERE id = ".$_SESSION['accused'];
$result = mysqli_query($db,$query);
$name = mysqli_fetch_assoc($result);

echo "The player you're accusing: ".$name['name'];
echo "<br>";
echo "Your detailed complaint: ".$_SESSION['description'];
echo "<br>";

if (!isset($_SESSION['description'])) {
  echo "Session data was lost. Please return to the <a style=color:orange href=card_award.php>AWARD CARD</a> form to try again.";
  die();
}


// PASSWORD FORM
?>
<div align=center>
<h2>Please enter your password to confirm the booking:</h2>
<form action="" method="POST">
<input type=password name=password value=<?php if(isset($_POST['password'])) echo $_POST['password'] ?>><br>
    <br><input style="float: none;" type=submit value="Award a Yellow Card">
</form><br>

<?php
// password validation

$query = "SELECT password, salt ";
$query .= "FROM users ";
$query .= "WHERE name = '".escape($user->data()->name)."'";
$result = mysqli_query($db,$query) or die ('Error querying database');
$row = mysqli_fetch_assoc($result);

if(!isset($_POST['password'])) {die();}

$hash = Hash::make($_POST['password'],$row['salt']);

if($hash != $row['password']) {die('First password is not correct');}

if($duplicate) {
  $query = "UPDATE cards SET description = '".htmlspecialchars($_SESSION['description'],ENT_QUOTES)."' WHERE id=".$existingcard['id'];
} else {
  $query = "INSERT INTO cards (accuser,accused,`datetime`,`description`)"; // query to INSERT new card details
  $query .= "VALUES (".escape($user->data()->id).",".$_SESSION['accused'].",now(),'".htmlspecialchars($_SESSION['description'],ENT_QUOTES)."')";
}
mysqli_query($db,$query) or die('Error adding card.');
echo "You have successfully awarded a <img width=18 src=layouts/images/yellowcard.png> to ".$name['name']."!<br>";

unset($_SESSION['accused']);
unset($_SESSION['description']);

?>
</div>
