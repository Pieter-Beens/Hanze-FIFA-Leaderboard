<title>Hanze FIFA Leaderboard</title>
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
//session_start();
$title = "LEADERBOARD";
include('layouts/header.php');
include('fifadbconn.php');

$query = "SELECT * ";
$query .= "FROM users ";
$query .= "ORDER BY score DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');
?>
<div style="margin: 40px; background-color: rgba(0, 0, 0, 0.30); padding: 20px; min-width: 900px;">
<table>
<tr style="background-color:white;color: black;font-size:24px;">
  <th>Rank</th>
  <th></th>
  <th style="text-align:left">User</th>
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
<tr style="cursor:pointer;" onclick="document.location='profile.php?user=<?php echo $row['id']?>'">
<td class="leaderboardTekst" style="text-align:center"><?php echo $rank ?></td>
<td ><b><img class="leaderboardTekst" src=<?php echo $row['avatar']?>></td>
<td style="text-align:left"><span class="leaderboard" style="color:orange;padding-left: 20px"><?php echo $row['name']?></span><span style="float: right; padding-top: 1px;padding-right: 20px;"><?php echo $card ?></span></td>
<td class="leaderboard" style="color:green;padding:10px"><b><?php echo $goalsfor ?></b></td>
<td class="leaderboard" style="color:red;padding:10px;"><b><?php echo $goalsagainst ?></b></td>
<td class="leaderboard"><b><?php echo round($row['score']) ?></b></td>
</tr>

<?php
};
?>

</table>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include('layouts/footer.html');
?>
