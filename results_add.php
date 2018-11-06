<title>Hanze FIFA Leaderboard - Add Results Form</title>

<?php

// PAGE SETUP

$title = "ADD RESULTS";
include('layouts/header.php');
require_once 'core/init.php';
include('fifadbconn.php');

// TIMER ATTEMPTS: (find a way to convert database string to datetime format)

//$query = "SELECT max(`datetime`) AS lasttime FROM results WHERE homeplayer = ".escape($user->data()->id)." OR awayplayer = ".escape($user->data()->id);
//$result = mysqli_query($db,$query) or die ('Error checking recent matches');
//$matchtime = mysqli_fetch_assoc($result);

//$date = date('m/d/Y h:i:s a', time());
//echo $date;
//$lastmatch = $matchtime['lasttime'];
//$datediff = date_diff($lastmatch,$date);

//echo "You last match was $datediff days ago.";

// QUERY for dropdown selection of opponent:
$query = "SELECT `name`";
$query .= "FROM `users` ORDER BY `name` ASC";
$result = mysqli_query($db,$query) or die ('Error querying database');

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="DennisGlobalCSSFIXER.css">


</head>
<body>
<br>
<br>
<div class="center-wrapper" style="min-width: 600px;">
<form action="results_confirm.php" method="POST">
<br>
<table style=margin:auto>
  <tr><td></td><td><div align="center"><h2>HOME</h2></div></td><td><div align="center"><h2>AWAY</h2></div></td></tr>
  <tr><td width=60>Players</td><td><input size=22 type="text" name='homeplayer' value=<?php echo escape($user->data()->name); ?> disabled></td>
    <td><select name='awayplayer' <?php if (isset($_POST['awayplayer'])) echo "value=".$_POST['awayplayer']; ?>>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['name'] != escape($user->data()->name)) {
        echo "<option value=";
        echo $row['name'];
        echo ">";
        echo $row['name'];
        echo "</option>";
      };
    }
    ?>
  </select></td><td width=60></td></tr>
  <tr><td>Goals</td><td><div align=center><input min=0 max=99 value=<?php if (isset($_POST['homegoals'])) {echo $_POST['homegoals'];} else {echo "0";} ?> style=width:100px;text-align:center;font-size:48pt type="number" name="homegoals"></div></td>
    <td><div align=center><input min=0 max=99 value=<?php if (isset($_POST['awaygoals'])) {echo $_POST['awaygoals'];} else {echo "0";} ?> style=width:100px;text-align:center;font-size:48pt type="number" name="awaygoals"></div></td></tr>
  <tr><td>Comment</td><td colspan=2><div align=center><input maxlength=55 style=width:350px type="text" name="description" <?php if (isset($_POST['description'])) echo "value=".$_POST['description']; ?>></div></td><td></td></tr>
  <tr><td></td><td colspan=2><div align=center><input style=height:40px type="submit" value="That's the score!"></div></td></tr>
</table>
</form>
</div>
</body>
</html>
