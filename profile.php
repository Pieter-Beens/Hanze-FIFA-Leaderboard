<?php
include('header/header.html');

include('fifadbconn.php');

$query = "SELECT name, avatar, realname, email, score FROM users WHERE id = ".$_GET['user'];
$result = mysqli_query($db,$query) or die ('Error finding username');
$user = mysqli_fetch_assoc($result);

$query = "SELECT score FROM users WHERE score > ".$user['score'];
$result = mysqli_query($db,$query) or die ('Error comparing user scores');
$ranking = mysqli_num_rows($result) + 1;

$query = "SELECT id FROM cards WHERE accused = ".$_GET['user'];
$cardresult = mysqli_query($db,$query) or die ('Error counting cards');
if (mysqli_num_rows($cardresult) > 1) {$card = "<img align=right height=150px src=red.png>";}
elseif (mysqli_num_rows($cardresult) == 1) {$card = "<img align=right height=150px src=yellow.png>";}
else {$card = "";}

echo "$card<br>";

echo "<img height=100 src=".$user['avatar'].">";
echo "<font style=color:white><font size=40><b>".$user['name']."</font><i> profile</i></h1><br>";
echo "Score: ".$user['score']."<br>Ranking: #".$ranking."<br>Real name: ".$user['realname']."<br>Email: ".$user['email']."<br>";

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
echo "<b>Goals: <font color=green>".$goalsfor."</font> for <font color=red>".$goalsagainst."</font> against<br>";

$query = "SELECT * ";
$query .= "FROM results ";
$query .= "WHERE homeplayer = ".$_GET['user']." OR awayplayer = ".$_GET['user'];
$query .= " ORDER BY `datetime` DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<table cellpadding=4 border=1 style=overflow:hidden;color:white;table-layout:fixed width=800>
  <colgroup>
    <col style=width:90px>
    <col style=width:50px>
    <col style=width:200px>
    <col style=width:30px>
    <col style=width:30px>
    <col style=width:200px>
    <col style=width:140px>
  </colgroup>
<tr>
<td style=font-size:22pt;text-align:center;background-color:green colspan=7>MATCH HISTORY</td>
</tr><tr style=background-color:black>
<th>Date</th><th>Result</th><th>Home Side</th><th colspan=2>Score</th><th>Away Side</th><th>Comment</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  $query = "SELECT `name`,`id` FROM `users` WHERE `id` = ".$row['homeplayer'];
  $homeresult = mysqli_query($db,$query) or die ('Error finding home player name');
  $homeplayer = mysqli_fetch_assoc($homeresult);
  $query = "SELECT `name`,`id` FROM `users` WHERE `id` = ".$row['awayplayer'];
  $awayresult = mysqli_query($db,$query) or die ('Error finding away player name');
  $awayplayer = mysqli_fetch_assoc($awayresult);
  if ($homeplayer['id'] == $_GET['user'] AND $row['homegoals'] > $row['awaygoals']) $wld = "<td style=background-color:green;text-align:center;font-size:28pt><b>W</b></td>";
  elseif ($awayplayer['id'] == $_GET['user'] AND $row['homegoals'] < $row['awaygoals']) $wld = "<td style=background-color:green;text-align:center;font-size:28pt><b>W</b></td>";
  elseif ($homeplayer['id'] == $_GET['user'] AND $row['homegoals'] < $row['awaygoals']) $wld = "<td style=background-color:red;text-align:center;font-size:28pt><b>L</b></td>";
  elseif ($awayplayer['id'] == $_GET['user'] AND $row['homegoals'] > $row['awaygoals']) $wld = "<td style=background-color:red;text-align:center;font-size:28pt><b>L</b></td>";
  else $wld = "<td style=background-color:blue;text-align:center;font-size:28pt><b>D</b></td>";
  echo "<tr>
  <td height=50>".$row['datetime']."</td>";
  echo $wld;
  echo "<td style=overflow:hidden;font-size:18pt><b><a style=color:orange href=profile.php?user=".$row['homeplayer'].">".$homeplayer['name']."</b></td>
  <td style=text-align:center;font-size:28pt><b>".$row['homegoals']."</b></td>
  <td style=text-align:center;font-size:28pt><b>".$row['awaygoals']."</b></td>";
  echo "<td cellpadding style=overflow:hidden;font-size:18pt;text-align:right><b><a style=color:orange href=profile.php?user=".$row['awayplayer'].">".$awayplayer['name']."</b></td>
  <td style=overflow:hidden>".$row['description']."</td>
  </tr>";
}

echo "</table>";

?>
