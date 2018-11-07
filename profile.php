<style>
table{
  border-collapse: collapse;
}
td,tr,table {
    text-align:center;


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


$query = "SELECT `datetime`, scorechange, homeplayer, home.name AS homename, homegoals, awaygoals, awayplayer, away.name AS awayname, description";
$query .= " FROM results JOIN users home ON homeplayer = home.id JOIN users away ON awayplayer = away.id";
$query .= " WHERE homeplayer = ".$_GET['user']." OR awayplayer = ".$_GET['user'];
$query .= " ORDER BY `datetime` DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');
?>





<div style="border-radius:20px;max-width:100%;margin:20px;padding: 20px;min-height: 30%;background-color: rgba(0, 0, 0, 0.30);">
<table style="width:100%;">

  <tr>
    <td style="width: 28vw" rowspan="6"><img style="width:20vw;" src="
      <?php if ($player['avatar'] == NULL)
      echo "layouts/images/awesomelogo.png";
            else
      echo $player['avatar'];
    ?>"></td>
      <td class="profileRank" rowspan="2"><?php echo "$ranking"?></td>
    <td class="profile"><?php echo "Score: $player[score]"?></td>
  </tr>

    <tr>
      <td class="profile"><?php echo "Historic high: $player[highscore]"?></td>
    </tr>

    <tr>
      <td class="profileBig"rowspan="2">Goals: <font color=green><?php echo $goalsfor ?></font> for <font color=red><?php echo $goalsagainst ?></font> against</font><br>Record: <font color=green><?php echo $wins ?></font> - <?php echo $draws ?> - <font color=red><?php echo $losses ?></font></td>
      <td class="profile"><?php echo "Real name: $player[realname]"?></td>
    </tr>

    <tr>
      <td class="profile"><?php echo "Email: $player[email]"?></td>
    </tr>

    <tr>
      <td><?php
      if ($card == "layouts/images/redcard.png" OR $card == "layouts/images/yellowcard.png"){
      ?>
      <img style="" class="cards" src="<?php echo $card?>">
      <?php } ?></td>
      <td class="profile"><?php echo "Join date: $player[joindate]"?></td>
    </tr>

    <tr>
      <td><?php
        if (Session::exists('user')) {
          if ($user->hasPermission('admin') || $_GET['user'] == escape($user->data()->id)) { // ik gebruik hier || en && want Joppe is mijn grote voorbeeld
          ?>
          <a class="profileBig" style="color:orange;" href=editdetails.php?user=<?php echo $_GET['user']?>>edit details</a>
          <?php }
        }?>
      </td>
      <td class="profile"><?php echo "Favoured team: $player[favteam]"?></td>
    </tr>


</table>
<hr>
</div>


<div style="margin: 20px;margin-bottom: 50px;background-color: rgba(0, 0, 0, 0.30)">
<table class="profileTable" style="width:100%">
<tr><td class="profile" style="background-color:green" colspan=7>MATCH HISTORY</td></tr>
<tr class="profile" style=background-color:black><th>Date</th><th>Result</th><th>Home Side</th><th colspan=2>Score</th><th>Away Side</th><th>Comment</th></tr>

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
  <td class="profile"><a style="color:orange;" href=profile.php?user=<?php echo $row['homeplayer']?>><?php echo $row['homename']?></td>
  <td class="profile"><?php echo $row['homegoals']?></td>
  <td class="profile"><?php echo $row['awaygoals']?></td>
  <td class="profile"><a style="color:orange;" href=profile.php?user=<?php echo $row['awayplayer']?>><?php echo $row['awayname']?></td>
  <td class="profile" style=font-family:sans-serif;max-width:300><?php echo htmlspecialchars_decode($row['description'])?></td>
  </tr>
<?php
}
?>
</table>
</div>
<?php
include_once ('layouts/footer.html');
?>
