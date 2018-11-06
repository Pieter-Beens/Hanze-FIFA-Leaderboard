<style>
table{
  border-collapse: collapse;
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
if (mysqli_num_rows($cardresult) > 1) {$card = "layouts/images/redcard.png";}
elseif (mysqli_num_rows($cardresult) == 1) {$card = "layouts/images/yellowcard.png";}
else {$card = "";}

echo "<title>Hanze FIFA Leaderboard - ".$player['name']."'s Profile</title>";

$title = $player['name'];

include('layouts/header.php');

?>
<div class="leaderboardDiv" style="max-width:40%; border-radius:20px">
  <?php
  if ($card == "layouts/images/redcard.png" OR $card == "layouts/images/yellowcard.png"){
  ?>
  <img style="float:right;margin:20px;" class="leaderboardTekst" src="<?php echo $card?>">
<?php } ?>
  <div style="background-color:red;width:100%;border-radius:20px">
<table>



  <td style="font-size:120px"><?php echo $ranking ?></td></tr>

</table>
</div>


<?php
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

echo "<td><font size=20><b>Record: <font color=green>".$wins."</font> - ".$draws." - <font color=red>".$losses."</font><br><td>";
echo "<b>Goals: <font color=green>".$goalsfor."</font> for <font color=red>".$goalsagainst."</font> against</font><br>";

$query = "SELECT `datetime`, scorechange, homeplayer, home.name AS homename, homegoals, awaygoals, awayplayer, away.name AS awayname, description";
$query .= " FROM results JOIN users home ON homeplayer = home.id JOIN users away ON awayplayer = away.id";
$query .= " WHERE homeplayer = ".$_GET['user']." OR awayplayer = ".$_GET['user'];
$query .= " ORDER BY `datetime` DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');
?>



</div>




<div style="margin: 40px; background-color: rgba(0, 0, 0, 0.30)">
<table style="width:100%">
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
