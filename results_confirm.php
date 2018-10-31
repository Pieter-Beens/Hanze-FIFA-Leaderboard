<?php

// PAGE SETUP

$title = "ADD RESULTS";
include('layouts/header.php');
require_once 'core/init.php';
include('fifadbconn.php');

if (isset($_POST['awayplayer'])) $_SESSION['awayplayer'] = $_POST['awayplayer'];

if (!isset($_SESSION['awayplayer'])) {
  echo "Something went wrong. To enter new match data, please select Add Result from the menu.";
  die();
}

if (!isset($_POST['homepass'])) {

// queries for player information that should go into the SESSION array
$query = "SELECT * ";
$query .= "FROM users ";
$query .= "WHERE name = '".escape($user->data()->name)."'";
$result = mysqli_query($db,$query) or die ('Error querying database');
$home = mysqli_fetch_assoc($result);

$query = "SELECT * ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_POST['awayplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database:'.$query);
$away = mysqli_fetch_assoc($result);

$homescore = $home['score'];
$awayscore = $away['score'];

$homegoals = $_POST["homegoals"];
$awaygoals = $_POST["awaygoals"]; // because arrays are unwieldy, the relevant elements are bound to regular vars

$_SESSION['homeplayer'] = $home['name'];
$_SESSION['awayplayer'] = $away['name'];

include('algorithm.php'); // calculates score change

$_SESSION['$change'] = $change; // binds to SESSION array for use in results_write.php

// prepares queries for PROCESS PHASE
$_SESSION['matchquery'] = "INSERT INTO results (homeplayer,homegoals,awaygoals,awayplayer,scorechange,`datetime`,`description`)"; // query to INSERT new match details
$_SESSION['matchquery'] .= "VALUES (".$home['id'].",".$homegoals.",".$awaygoals.",".$away['id'].",$change,now(),'".$_POST['description']."')";

$_SESSION['$homequery'] = "UPDATE users SET score=".$newhomescore." WHERE id=".$home['id'];
if ($newhomescore > $home['highscore']) {$_SESSION['$homequery'] .= ", highscore=".$newhomescore;}
$_SESSION['$homequery'] .= " WHERE name='". $_SESSION['homeplayer'] ."'";

$_SESSION['$awayquery'] = "UPDATE users SET score=".$newawayscore." WHERE id=".$away['id'];
if ($newawayscore > $away['highscore']) {$_SESSION['$awayquery'] .= ", highscore=".$newawayscore;}
$_SESSION['$awayquery'] .= " WHERE name='". $_SESSION['awayplayer'] ."'";

$_SESSION['homepass'] = $home['password'];
$_SESSION['awaypass'] = $away['password'];

}

// PASSWORD FORM

?>
<div align=center>
<h2>Please enter both players' passwords:</h2>
<form action="" method="POST">
<?php echo $_SESSION['homeplayer'] ?><br>
<input type=password name=homepass value=<?php if(isset($_POST['homepass'])) echo $_POST['homepass'] ?>><br>
<?php echo $_SESSION['awayplayer'] ?><br>
<input type=password name=awaypass value=<?php if(isset($_POST['awaypass'])) echo $_POST['awaypass'] ?>><br>
<input type=submit value="CONFIRM RESULT">
</form>
</div>

<?php
// password validation

$query = "SELECT password ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['homeplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database');
$home = mysqli_fetch_assoc($result);

$query = "SELECT password ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['awayplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database:'.$query);
$away = mysqli_fetch_assoc($result);



if(!isset($_POST['homepass'])) {die();}

$homehash = Hash::make($_POST['homepass']);
$awayhash = Hash::make($_POST['awaypass']);

if($homehash != $_SESSION['homepass']) {die('First password is not correct');}
if($awayhash != $_SESSION['awaypass']) {die('Second password is not correct');}

Redirect::to("results_write.php");

?>
