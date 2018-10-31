<?php

if (!isset($_SESSION['matchquery'])) { // should only happen when results have been sent already
	die ('ERROR: All data relating to this match has been lost.<br>Did you try to refresh the page after confirming your results? Stop trying to cheat!');
};

mysqli_query($db,$_SESSION['matchquery']) or die('match update failed');
mysqli_query($db,$_SESSION['awayquery']) or die('away update failed');
mysqli_query($db,$_SESSION['homequery']) or die('home update failed');

// THIS FILE LACKS SESSION VARS

?>

<div border=1 align=center><h3><?php echo $homeplayer ?></h3>
	<h1><?php if($change <= 0) {echo "<div style=color:red>".round($newhomescore,1)."</style>";} else {echo "<div style=color:green>".round($newhomescore,1)."</style>";}?></h1>
	<div style=position:relative><img width=200px src=layouts/images/<?php if($change >= 0) {echo "arrowup";} else {echo "arrowdown";}?>.png><div style=font-size:70pt;color=black;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);><?php echo "<b>".abs(round($change,1))."</b>"?></div></div>
	<h1><?php if($change >= 0) {echo "<div style=color:red>".round($newawayscore,1)."</style>";} else {echo "<div style=color:green>".round($newawayscore,1)."</style>";}?></h1>
	<h3><?php echo $awayplayer?></h3>
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
