<?php

include('header/header.html');

include('fifadbconn.php');

echo "<font style=color:white>";

$_SESSION['role'] = 'admin';
$_SESSION['id'] = 2; // test, should be retrieved from database and assigned to SESSION var at login

if ($_SESSION['id'] != $_GET['user'] and $_SESSION['role'] != 'admin') die('You do not have permission to view this page.');

if (isset($_POST['name'])) {
$query = "UPDATE users ";
$query .= "SET name = '".$_POST['name']."', realname = '".$_POST['realname']."', avatar= '".$_POST['avatar']."'";
$query .= "WHERE id = ".$_GET['user'];
mysqli_query($db,$query) or die ('Error writing to database. Changes were not saved.');

echo "Changes were saved successfully!<br><a style=color:orange href=profile.php?user=".$_SESSION['id'].">Return to your Profile.</a>";
}

$query = "SELECT `name`, email, `realname`, avatar FROM users WHERE id =".$_GET['user'];
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);

?>
<font style=color:white>
<form method=POST action="">
  <b>USERNAME:<br>
  <input type=text value=<?php echo $row['name'] ?> name=name><br>
  Email:<br>
  <input type=text value=<?php echo $row['email'] ?> disabled><br>
  Real name:<br>
  <input type=text value="<?php echo $row['realname'] ?>" name=realname><br>
  Avatar URL:<br>
  <input type=text value=<?php echo $row['avatar'] ?> name=avatar><br>
  <img height=100px src=<?php echo $row['avatar'] ?>><br>
  <input type=submit value="Save Changes">
</form><br>
