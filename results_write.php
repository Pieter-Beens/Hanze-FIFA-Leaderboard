<?php

// PAGE SETUP

$title = "ADD RESULTS";
include('layouts/header.php');
require_once 'core/init.php';
include('fifadbconn.php');

if (!isset($_SESSION['matchquery'])) { // should only happen when results have been sent already
	die ('ERROR: All data relating to this match has been lost.<br>Did you try to refresh the page after confirming your results? Stop trying to cheat!');
};

// UPDATE
mysqli_query($db,$_SESSION['matchquery']) or die('match update failed');
mysqli_query($db,$_SESSION['awayquery']) or die("Away update failed. Query: ".$_SESSION['awayquery']);
mysqli_query($db,$_SESSION['homequery']) or die("Away update failed. Query: ".$_SESSION['homequery']);

// collecting updated scores to echo
$query = "SELECT score ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['homeplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database');
$home = mysqli_fetch_assoc($result);

$query = "SELECT score ";
$query .= "FROM users ";
$query .= "WHERE name = '".$_SESSION['awayplayer']."'";
$result = mysqli_query($db,$query) or die ('Error querying database:'.$query);
$away = mysqli_fetch_assoc($result);

?>

<div border=1 align=center><h3><?php echo $_SESSION['homeplayer'] ?></h3>
	<h1><?php if($_SESSION['change'] <= 0) {echo "<div style=color:red>".round($home['score'],1)."</style>";} else {echo "<div style=color:green>".round($home['score'],1)."</style>";}?></h1>
	<div style=position:relative><img width=200px src=layouts/images/<?php if($_SESSION['change'] > 0) {echo "arrowup";} elseif($_SESSION['change'] == 0) {echo "arrow0";} else {echo "arrowdown";}?>.png><div style=font-size:70pt;color=black;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);><?php echo "<b>".abs(round($_SESSION['change'],1))."</b>"?></div></div>
	<h1><?php if($_SESSION['change'] >= 0) {echo "<div style=color:red>".round($away['score'],1)."</style>";} else {echo "<div style=color:green>".round($away['score'],1)."</style>";}?></h1>
	<h3><?php echo $_SESSION['awayplayer']?></h3>
	<a style=color:orange href=leaderboard.php>Return to the Leaderboard</a>
</div>
<br><br>

<?php
unset($_SESSION['matchquery']); // prevents an exploit where refreshing the page submits the same results over and over
unset($_SESSION['homequery']);
unset($_SESSION['awayquery']);
unset($_SESSION['change']);
unset($_SESSION['homeplayer']);
unset($_SESSION['awayplayer']);

include ('layouts/footer.html');
?>
