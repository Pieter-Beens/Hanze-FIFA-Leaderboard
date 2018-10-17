<title>Hanze FIFA Leaderboard</title>

<?php
include('layouts/header.html');

include('fifadbconn.php');

$query = "SELECT * ";
$query .= "FROM users ";
$query .= "ORDER BY score DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<table style=align:center;color:white border=1>
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
</tr>";
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
  if (mysqli_num_rows($cardresult) > 1) {$card = "<img height=18px src=red.png>";}
  elseif (mysqli_num_rows($cardresult) == 1) {$card = "<img height=18px src=yellow.png>";}
  else {$card = "";}

$rank++;

echo "<tr>
<td><font size=18pt>$rank</font></td>
<td style=text-align:center><b><img height=36px src=".$row['avatar']."></td>
<td><b><a style=color:orange href=profile.php?user=".$row['id'].">".$card.$row['name']."</b></td>
<td style=text-align:right;color:green><b>".$goalsfor."</b></td>
<td style=text-align:right;color:red><b>".$goalsagainst."</b></td>
<td style=text-align:right;font-size:16pt><b>".round($row['score'],1)."</b></td>
</tr>";
};

?>
<?php
include ('layouts/header.html');
?>
