<?php

session_start();

include('fifadbconn.php'); // database connection

if (isset($_POST['awayplayer'])) { // binds POST vars from last page to global SESSION vars, needed because this page will reload
	$_SESSION['awayplayer'] = $_POST['awayplayer'];
	$_SESSION["homegoals"] = $_POST["homegoals"];
	$_SESSION["awaygoals"] = $_POST["awaygoals"];
	$_SESSION["description"] = $_POST["description"];
};
if (!isset($_SESSION)) { // warning if session has somehow ended, likely when players are trying to cheat by F5'ing the INSERT query...
	die ('Session data has been lost. If you think your results have not been registered, please reload the ADD RESULTS form to try again.');
};


$query = "SELECT * ";
$query .= "FROM players ";
$query .= "WHERE playernames = 'KabouterKlop77'"; // username should be gathered from login info
$result = mysqli_query($db,$query) or die ('Error querying database');

$home = mysqli_fetch_assoc($result);

$query = "SELECT * ";
$query .= "FROM players ";
$query .= "WHERE playernames = '";
$query .= $_SESSION['awayplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database:'.$query);

$away = mysqli_fetch_assoc($result);

$homescore = $home['scores'];
$awayscore = $away['scores'];

$homeplayer = 'KabouterKlop77'; // SHOULD BE GATHERED FROM LOGIN DATA
$awayplayer = $_SESSION['awayplayer'];

$homegoals = $_SESSION["homegoals"];
$awaygoals = $_SESSION["awaygoals"]; // because arrays are unwieldy, the relevant elements are bound to regular vars

echo "<div style=color:blue><i>You entered the following information:</i></div>";
echo "<div style=align:center><b>$homeplayer  <text style=color:red>$homegoals - $awaygoals</text>  $awayplayer</b></div>";
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
$homepass = $home['passwords'];
$awaypass = $away['passwords'];

if(!isset($_POST['homepass'])) {die();}
elseif($_POST['homepass'] != $homepass) {die('First password is not correct');}
elseif($_POST['awaypass'] != $awaypass) {die('Second password is not correct');}
else {
	$rate = 1; // can be changed to increase or decrease rate at which score changes

	$win = 2;
	$loss = -2;

	If ($homegoals >= $awaygoals) { // did player win or lose?
		$winloss = $win;
	} Else {
		$winloss = $loss;
	};

	If ($homegoals == $awaygoals) { // points earned for draws
		If ($homescore < $awayscore) {
			$change = (1 * $rate) * ($awayscore / $homescore);
		} Elseif ($homescore > $awayscore) {
			$change = -(1 * $rate) * ($homescore / $awayscore);
		} Else {
			$change = 0;
		};
	} Else {
		$change = (($homegoals - $awaygoals) + $winloss) * ($awayscore / $homescore); // points earned goal difference + win/loss
	};

	$newhomescore = $homescore + $change;
	$newawayscore = $awayscore - $change;
}
?>

<div border=1 align=center><h3><?php echo $homeplayer?></h3>
	<h1><?php if($change <= 0) {echo "<div style=color:red>".round($newhomescore,1)."</style>";} else {echo "<div style=color:green>".round($newhomescore,1)."</style>";}?></h1>
	<div style=position:relative><img width=200px src=<?php if($change >= 0) {echo "arrowup";} else {echo "arrowdown";}?>.png><div style=font-size:70pt;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);><?php echo "<b>".abs(round($change,1))."</b>"?></div></div>
	<h1><?php if($change >= 0) {echo "<div style=color:red>".round($newawayscore,1)."</style>";} else {echo "<div style=color:green>".round($newawayscore,1)."</style>";}?></h1>
	<h3><?php echo $awayplayer?></h3>
	<a href=Leaderboard>Return to the Leaderboard</a>
</div>

<?php
$query = "UPDATE players"; // query to UPDATE home player's score
$query .= "SET scores = '";
$query .= $newhomescore."'";
$query .= "WHERE playernames = '";
$query .= $homeplayer."'";
mysqli_query($db,$query) or die ('<b>Error querying database. Your results have not been saved!');
$query = "UPDATE players"; // query to UPDATE away player's score
$query .= "SET scores = '";
$query .= $newawayscore."'";
$query .= "WHERE playernames = '";
$query .= $awayplayer."'";
mysqli_query($db,$query) or die ('<b>Error querying database. Your results have not been saved! away');
$query = "INSERT INTO matches"; // query to INSERT new match details
$query .= "VALUES (now(),".$homeplayer.",".$homegoals.",".$awaygoals.",".$awayplayer.")"; //CHECK DATABASE FOR ACCURATE NAMES/ORDER (also matches) (also does now() work this way?)

unset($_SESSION['awayplayer']);
?>
