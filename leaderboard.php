<title>Hanze FIFA Leaderboard</title>

<?php

session_start();

$title = "LEADERBOARD";

include('layouts/header.php');

include('fifadbconn.php');

$query = "SELECT * ";
$query .= "FROM users ";
$query .= "ORDER BY score DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');
?>

<table style=align:center;color:white border=1>
<tr>
  <td style=background-color:red;color:white colspan=6><h2 align=center>Leaderboard</h2></td>
</tr>
<tr style=background-color:black>
  <th>Rank</th>
  <th></th>
  <th>User</th>
  <th>GF</th>
  <th>GA</th>
  <th>Score</th>
</tr>

<?php
$rank=0;
while ($row = mysqli_fetch_assoc($result)) { // Uitlezen van data opgehaald uit database

  $goalsfor=0;
  $goalsagainst=0;

  $query = "SELECT homegoals, awaygoals FROM results WHERE homeplayer = '".$row['id']."'";
  $gfaresult = mysqli_query($db,$query) or die ('Error querying database: Homegames');
  while ($gfa = mysqli_fetch_assoc($gfaresult)) {
    $goalsfor += $gfa['homegoals'];
    $goalsagainst += $gfa['awaygoals'];
  }
  $query = "SELECT homegoals, awaygoals FROM results WHERE awayplayer = '".$row['id']."'";
  $gfaresult = mysqli_query($db,$query) or die ('Error querying database: Awaygames');
  while ($gfa = mysqli_fetch_assoc($gfaresult)) {
    $goalsfor += $gfa['awaygoals'];
    $goalsagainst += $gfa['homegoals'];
  }
  $query = "SELECT id FROM cards WHERE accused = '".$row['id']."'";
  $cardresult = mysqli_query($db,$query) or die ('Error counting cards');
  if (mysqli_num_rows($cardresult) > 1) {$card = "<img height=18px src=layouts/images/redcard.png>";}
  elseif (mysqli_num_rows($cardresult) == 1) {$card = "<img height=18px src=layouts/images/yellowcard.png>";}
  else {$card = "";}

$rank++;

?>
<tr>
<td><font size=18pt><?php echo $rank ?></font></td>
<td style=text-align:center><b><img height=36px src=<?php echo $row['avatar']?>></td>
<td><b><a style=color:orange href=profile.php?user=<?php echo $row['id']?>><?php echo $card.$row['name']?></b></td>
<td style=text-align:right;color:green><b><?php echo $goalsfor ?></b></td>
<td style=text-align:right;color:red><b><?php echo $goalsagainst ?></b></td>
<td style=text-align:right;font-size:16pt><b><?php echo round($row['score']) ?></b></td>
</tr>

<?php
};
?>

</table>
<br><br><br><br><br><br><br><br>

<?php
include_once ('layouts/footer.html');
?>
