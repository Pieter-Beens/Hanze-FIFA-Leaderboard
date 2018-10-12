<?php

include('fifadbconn.php');

$query = "SELECT playernames ";
$query .= "FROM players ";
$query .= "WHERE playernames = 'KabouterKlop77'"; // username should be gathered from login info: $_SESSION['username']
$result = mysqli_query($db,$query) or die ('Error querying database');

$row = mysqli_fetch_assoc($result);

$query = "SELECT playernames, passwords, scores ";
$query .= "FROM players";
$result = mysqli_query($db,$query) or die ('Error querying database');

?>

<html>
<body>

<fieldset><legend><b>ADD RESULTS</b></legend><form action="processresults.php" method="POST">
<div align="center"><img height=150 src="http://pluspng.com/img-png/fifa-logo-png-fifa-logo-685.png"></div>
<table style=margin:auto>
  <tr><td></td><td><div align="center"><h2>HOME</h2></div></td><td><div align="center"><h2>AWAY</h2></div></td></tr>
  <tr><td width=60><b>Players</b></td><td><input size=22 type="text" name='homeplayer' value=<?php echo $row['playernames']; ?> disabled></td>
    <td><select name='awayplayer'><option value="">SELECT AN OPPONENT</option>
    <?php
    while ($namerow = mysqli_fetch_assoc($result)) {
      if ($namerow['playernames'] != $row['playernames']) {
        echo "<option value=";
        echo $namerow['playernames'];
        echo ">";
        echo $namerow['playernames'];
        echo "</option>";
      };
    }
    ?>
  </select></td><td width=60></td></tr>
  <tr><td><b>Goals</b></td><td><div align=center><input min=0 max=12 value=0 style=width:80px;text-align:center;font-size:48pt type="number" name="homegoals"></div></td>
    <td><div align=center><input min=0 max=12 value=0 style=width:80px;text-align:center;font-size:48pt type="number" name="awaygoals"></div></td></tr>
  <tr><td><b>Comment</b></td><td colspan=2><div align=center><input maxlength=55 style=width:350px type="text" name="description"></div></td><td><i>max. 55ch</i></td></tr>
  <tr><td></td><td colspan=2><div align=center><input style=height:40px type="submit" value="That's how it is!"></div></td></tr>
</table>
</form>
</fieldset>
</body>
</html>
