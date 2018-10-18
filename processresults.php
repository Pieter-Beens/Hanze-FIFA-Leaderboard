<title>Hanze FIFA Leaderboard - Confirm Result</title>

<?php

$title = "ADD RESULTS";

include('layouts/header.html');

session_start();

include('fifadbconn.php'); // database connection

if (isset($_POST['awayplayer'])) { // binds POST vars from last page to global SESSION vars, needed because this page will reload
	$_SESSION['awayplayer'] = $_POST['awayplayer'];
	$_SESSION["homegoals"] = $_POST["homegoals"];
	$_SESSION["awaygoals"] = $_POST["awaygoals"];
	$_SESSION["description"] = $_POST["description"];
} else {die('ERROR: Data from the last page did not make it here. Are you sure you entered all fields correctly? If you tried to refresh this page after confirming your results, your data was thrown out to prevent cheating.');}
if (!isset($_SESSION)) { // warning if session has somehow ended, likely when players are trying to cheat by F5'ing the INSERT query...
	die ('Session data has been lost. If you think your results have not been registered, please reload the ADD RESULTS form to try again.');
};


$query = "SELECT * ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['name']."'"; // username gathered from SESSION element assigned on an earlier page
$result = mysqli_query($db,$query) or die ('Error querying database');
$home = mysqli_fetch_assoc($result);

$query = "SELECT * ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['awayplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database:'.$query);
$away = mysqli_fetch_assoc($result);

$homescore = $home['score'];
$awayscore = $away['score'];

$homeplayer = $_SESSION['name']; // username gathered from SESSION element assigned on an earlier page
$awayplayer = $_SESSION['awayplayer'];

$homegoals = $_SESSION["homegoals"];
$awaygoals = $_SESSION["awaygoals"]; // because arrays are unwieldy, the relevant elements are bound to regular vars

echo "<div style=color:blue><i>You entered the following information:</i></div>";
echo "<div style=align:center><b>$homeplayer <text style=color:red>$homegoals - $awaygoals</text> $awayplayer</b></div>";
echo "<b>Comment:</b> ".$_SESSION["description"];
echo "<div style=color:blue><i>Please enter both players' passwords to confirm this result:</i></div><br/>";

?>

<form action="" method="POST">
<?php echo $homeplayer ?><br>
<input type=password name=homepass value=<?php if(isset($_POST['homepass'])) echo $_POST['homepass'] ?>><br>
<?php echo $awayplayer ?><br>
<input type=password name=awaypass value=<?php if(isset($_POST['awaypass'])) echo $_POST['awaypass'] ?>><br>
<input type=submit value="CONFIRM RESULT">
</form>


<?php
$homepass = $home['password'];
$awaypass = $away['password'];

if(!isset($_POST['homepass'])) {die();}
elseif($_POST['homepass'] != $homepass) {die('First password is not correct');}
elseif($_POST['awaypass'] != $awaypass) {die('Second password is not correct');}
else {
	include('algorithm.php');
}

$query = "INSERT INTO results (homeplayer,homegoals,awaygoals,awayplayer,`datetime`,`description`)"; // query to INSERT new match details
$query .= "VALUES (".$home['id'].",".$homegoals.",".$awaygoals.",".$away['id'].",now(),'".$_SESSION['description']."')";
mysqli_query($db,$query) or die ('Error INSERTing results data. No changes have been written to the database.');
$query = "UPDATE users SET score='". $newhomescore ."' WHERE name='". $homeplayer ."'";
mysqli_query($db,$query) or die ('<b>Error UPDATING home player score. Match data has been saved but scores have not changed.');
$query = "UPDATE users SET score='". $newawayscore ."' WHERE name='". $awayplayer ."'";
mysqli_query($db,$query) or die ('<b>Error UPDATING away player score. Match data has been saved but only the home player score has been changed!');

?>

<div border=1 align=center><h3><?php echo $homeplayer?></h3>
	<h1><?php if($change <= 0) {echo "<div style=color:red>".round($newhomescore,1)."</style>";} else {echo "<div style=color:green>".round($newhomescore,1)."</style>";}?></h1>
	<div style=position:relative><img width=200px src=layouts/images<?php if($change >= 0) {echo "arrowup";} else {echo "arrowdown";}?>.png><div style=font-size:70pt;color=black;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);><?php echo "<b>".abs(round($change,1))."</b>"?></div></div>
	<h1><?php if($change >= 0) {echo "<div style=color:red>".round($newawayscore,1)."</style>";} else {echo "<div style=color:green>".round($newawayscore,1)."</style>";}?></h1>
	<h3><?php echo $awayplayer?></h3>
	<a href=../leaderboard.php>Return to the Leaderboard</a>
</div>

<?php
unset($_SESSION['awayplayer']); // prevents an exploit where refreshing the page submits the same results over and over
?>
