<?php

include('fifadbconn.php');

$query = "SELECT * ";
$query .= "FROM players ";
$query .= "WHERE playernames = 'KabouterKlop77'"; // is example, username should be gathered from login info
$result = mysqli_query($db,$query) or die ('Error querying database');

$scorerow = mysqli_fetch_assoc($result);

$query = "SELECT playernames, passwords, scores ";
$query .= "FROM players";
$result = mysqli_query($db,$query) or die ('Error querying database');

while ($row = mysqli_fetch_assoc($result)) {
$scorescolumn[$row['playernames']] = $row['scores'];
};

?>

<html>
<body>

<fieldset><legend><b>ADD RESULTS</b></legend><form action="algorithm.php" method="post">
<table>
  <tr><td width=300>Your current leaderboard score: </td><td><input type="text" name="score" value=<?php echo $scorerow['scores']; ?> disabled></td></tr>
  <tr><td width=300>Your opponent: </td><td><select name="awayplayer">
    <?php
    while ($namerow = mysqli_fetch_assoc($result)) {
      if ($namerow['playernames'] != 'KabouterKlop77') { // again example, username should be gathered from login info
        echo "<option value=";
        echo $namerow['playernames'];
        echo ">";
        echo $namerow['playernames'];
        echo "</option>";
      };
    }
    ?>
  </select></td></tr>
  <tr><td width=300>Your opponent's current leaderboard score: </td><td><input type="number" name="opponentscore"></td></tr>
  <tr><td width=300>Number of goals they scored: </td><td><input type="number" name="opponentgoals"></td></tr><br>
  <tr><td>Number of goals you scored: </td><td><input type="number" name="yourgoals"></td></tr></table>
<input type="submit" value="GOGOGOGO">
</form>
</fieldset>
<img height=150 src="http://pluspng.com/img-png/fifa-logo-png-fifa-logo-685.png">
</body>
</html>
