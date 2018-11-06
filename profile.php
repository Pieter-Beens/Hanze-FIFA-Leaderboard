<style>
table{
  border-collapse: collapse;
  width: 100% ;
}
td,tr {
    text-align:center;
}
tr:nth-child(even){
  background-color: rgba(0, 0, 0, 0.40);
}
tr:hover td{
  background-color: black;
}
</style>
<?php

require_once 'core/init.php';

include('fifadbconn.php');

$query = "SELECT name, avatar, realname, email, highscore, joindate, favteam, score FROM users WHERE id = ".$_GET['user'];
$result = mysqli_query($db,$query) or die ('Error finding username');
$player = mysqli_fetch_assoc($result);

$query = "SELECT score FROM users WHERE score > ".$player['score'];
$result = mysqli_query($db,$query) or die ('Error comparing user scores');
$ranking = mysqli_num_rows($result) + 1;

$query = "SELECT id FROM cards WHERE accused = ".$_GET['user'];
$cardresult = mysqli_query($db,$query) or die ('Error counting cards');
if (mysqli_num_rows($cardresult) > 1) {$card = "<img align=right height=150px src=layouts/images/redcard.png>";}
elseif (mysqli_num_rows($cardresult) == 1) {$card = "<img align=right height=150px src=layouts/images/yellowcard.png>";}
else {$card = "";}

echo "<title>Hanze FIFA Leaderboard - ".$player['name']."'s Profile</title>";

$title = "<img height=80 align=center src=".$player['avatar']."> ".$player['name'];

include('layouts/header.php');

echo "$card<br>";

echo "<h1 style=font-color:gold;font-size:32pt>#".$ranking."</h1>";
echo "Score: ".$player['score']."<br>Historic high: ".$player['highscore']."<br>Real name: ".$player['realname']."<br>Email: ".$player['email']."<br>Join date: ".$player['joindate']."<br>Favoured team: ".$player['favteam']."<br>";
if (Session::exists('user')) {
  if ($user->hasPermission('admin') || $_GET['user'] == escape($user->data()->id)) { // ik gebruik hier || en && want Joppe is mijn grote voorbeeld
  echo "<i><a style=color:orange;font-size:16pt href=editdetails.php?user=".$_GET['user'].">edit details</a></i><br>";
  }
}

$goalsfor = 0;
$goalsagainst = 0;
$wins = 0;
$draws = 0;
$losses = 0;

$query = "SELECT homegoals, awaygoals FROM results WHERE homeplayer = ".$_GET['user'];
$gfaresult = mysqli_query($db,$query) or die ('Error querying database: Homegames');
while ($gfa = mysqli_fetch_assoc($gfaresult)) {
  $goalsfor += $gfa['homegoals'];
  $goalsagainst += $gfa['awaygoals'];
  if ($gfa['awaygoals'] < $gfa['homegoals']) $wins++;
  elseif ($gfa['awaygoals'] > $gfa['homegoals']) $losses++;
  else $draws++;
}
$query = "SELECT homegoals, awaygoals FROM results WHERE awayplayer = ".$_GET['user'];
$gfaresult = mysqli_query($db,$query) or die ('Error querying database: Awaygames');
while ($gfa = mysqli_fetch_assoc($gfaresult)) {
  $goalsfor += $gfa['awaygoals'];
  $goalsagainst += $gfa['homegoals'];
  if ($gfa['awaygoals'] > $gfa['homegoals']) $wins++;
  elseif ($gfa['awaygoals'] < $gfa['homegoals']) $losses++;
  else $draws++;
}

echo "<font size=20><b>Record: <font color=green>".$wins."</font> - ".$draws." - <font color=red>".$losses."</font><br>";
echo "<b>Goals: <font color=green>".$goalsfor."</font> for <font color=red>".$goalsagainst."</font> against</font><br>";

$query = "SELECT `datetime`, scorechange, homeplayer, home.name AS homename, homegoals, awaygoals, awayplayer, away.name AS awayname, description";
$query .= " FROM results JOIN users home ON homeplayer = home.id JOIN users away ON awayplayer = away.id";
$query .= " WHERE homeplayer = ".$_GET['user']." OR awayplayer = ".$_GET['user'];
$query .= " ORDER BY `datetime` DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');
?>
<div style="margin: 40px; background-color: rgba(0, 0, 0, 0.30); padding: 20px">
<table>
<tr>
<td style=font-size:30pt;text-align:center;background-color:green colspan=7>MATCH HISTORY</td>
</tr><tr style=background-color:black>
<th>Date</th><th>Result</th><th>Home Side</th><th colspan=2>Score</th><th>Away Side</th><th>Comment</th></tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
  if ($row['homeplayer'] == $_GET['user'] AND $row['homegoals'] > $row['awaygoals']) $wld = "<td width= 100 style=background-color:green;text-align:center;font-size:36pt><b>W</b></td>";
  elseif ($row['awayplayer'] == $_GET['user'] AND $row['homegoals'] < $row['awaygoals']) $wld = "<td width= 100 style=background-color:green;text-align:center;font-size:36pt><b>W</b></td>";
  elseif ($row['homeplayer'] == $_GET['user'] AND $row['homegoals'] < $row['awaygoals']) $wld = "<td width= 100 style=background-color:red;text-align:center;font-size:36pt><b>L</b></td>";
  elseif ($row['awayplayer'] == $_GET['user'] AND $row['homegoals'] > $row['awaygoals']) $wld = "<td width= 100 style=background-color:red;text-align:center;font-size:36pt><b>L</b></td>";
  else $wld = "<td style=background-color:blue;text-align:center;font-size:28pt><b>D</b></td>";
  ?>
  <tr>
  <td width=120 height=50><?php echo $row['datetime']?></td>
  <?php echo $wld ?>
  <td><b><a style=color:orange;font-size:24pt href=profile.php?user=<?php echo $row['homeplayer']?>><?php echo $row['homename']?></b></td>
  <td style=text-align:center;font-size:36pt><b><?php echo $row['homegoals']?></b></td>
  <td style=text-align:center;font-size:36pt><b><?php echo $row['awaygoals']?></b></td>
  <td><b><a style=color:orange;font-size:24pt href=profile.php?user=<?php echo $row['awayplayer']?>><?php echo $row['awayname']?></b></td>
  <td style=font-family:sans-serif;max-width:300><?php echo htmlspecialchars_decode($row['description'])?></td>
  </tr>
<?php
}
?>
</table>
</div>

<?php
include_once ('layouts/footer.html');
?>
