<title>Hanze FIFA Leaderboard - Add Results Form</title>

<?php

$title = "Add Results";

include('layouts/header.html');

session_start();
$_SESSION['name'] = 'KabouterKlop77'; // test, player info name be retrieved from database and set to SESSION var at login

include('fifadbconn.php');

$query = "SELECT `name`";
$query .= "FROM `users`";
$result = mysqli_query($db,$query) or die ('Error querying database');

?>

<html>
<body>

<fieldset><legend>ADD RESULTS</legend><form action="processresults.php" method="POST">
<div align="center"><img height=150 src="http://pluspng.com/img-png/fifa-logo-png-fifa-logo-685.png"></div>
<table style=margin:auto>
  <tr><td></td><td><div align="center"><h2>HOME</h2></div></td><td><div align="center"><h2>AWAY</h2></div></td></tr>
  <tr><td width=60>Players</td><td><input size=22 type="text" name='homeplayer' value=<?php echo $_SESSION['name']; ?> disabled></td>
    <td><select name='awayplayer'><option value="">SELECT AN OPPONENT</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['name'] != $_SESSION['name']) {
        echo "<option value=";
        echo $row['name'];
        echo ">";
        echo $row['name'];
        echo "</option>";
      };
    }
    ?>
  </select></td><td width=60></td></tr>
  <tr><td>Goals</td><td><div align=center><input min=0 max99 value=0 style=width:80px;text-align:center;font-size:48pt type="number" name="homegoals"></div></td>
    <td><div align=center><input min=0 max=99 value=0 style=width:80px;text-align:center;font-size:48pt type="number" name="awaygoals"></div></td></tr>
  <tr><td>Comment</td><td colspan=2><div align=center><input maxlength=55 style=width:350px type="text" name="description"></div></td><td><i>max. 55ch</i></td></tr>
  <tr><td></td><td colspan=2><div align=center><input style=height:40px type="submit" value="That's how it is!"></div></td></tr>
</table>
</form>
</fieldset>
</body>
</html>
