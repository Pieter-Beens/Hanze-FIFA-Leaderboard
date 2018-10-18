<?php

include ('../fifadbconn.php');

$query = "SELECT `name`";
$query .= "FROM `users`";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<form method=POST action=''><select name=user><option>SELECT A USER</option>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value=";
    echo $row['name'];
    echo ">";
    echo $row['name'];
    echo "</option>";
}

echo "</select><input type=submit value=Login></form>";

if (isset($_POST['user'])) {
  session_start();

  $query = "SELECT * FROM users WHERE name = '".$_POST['user']."'";
  $result = mysqli_query($db,$query) or die ('Error loading user data.');
  $_SESSION = mysqli_fetch_assoc($result);

  //global $_SESSION['id'] = 2;
  //global $_SESSION['role'] = 'admin';

  echo "<br>You are now logged in as <b>".$_SESSION['name']."<br><a href=../leaderboard.php>Return to the Leaderboard</a>";

}

?>
