<?php
$title = 'Manage Cards';
Include_once('layouts/header.php');
include_once('core/init.php');
include_once('fifadbconn.php');

$query2 = "SELECT `name`";
$query2 .= "FROM `users` ORDER BY `name` ASC";
$result2 = mysqli_query($db,$query2) or die ('Error querying database');
?>
<br>
<br>
<div class="center-wrapper" style="width: 512px;">
<form class="" action="" method="post">
    <h3>Find cards awarded to:</h3>
<select name="geval">
  <?php
  while ($row = mysqli_fetch_assoc($result2)) {
      echo "<option value=";
      echo $row['name'];
      echo ">";
      echo $row['name'];
      echo "</option>";
  }
  ?>
</select>
  <input type="submit" name="submit" value="Submit">
</form>
</div>
<link rel="stylesheet" type="text/css" href="DennisGlobalCSSFIXER.css">

<br>
<br>
<style>
table{
  border-collapse: collapse;
  font-family: sans-serif;
  width: 100%;
}
td {
  text-align:left;
  vertical-align:top;
  padding: 4px;
}
th{
  font-size:14pt;
}
tr:nth-child(even){
  background-color: rgba(0, 0, 0, 0.40);
}

</style>

<table>
<tr style="background-color:white; color: black;"><th>#</th><th>Accused</th><th>Accuser</th><th>Complaint</th><th>Date and time</th>
<?php

$query = "select c.id As 'Cardid' , u.name as Accused , u2.name as Accuser, c.description, c.datetime as 'time'";
$query .= " from cards c join users u on c.accused = u.id join users u2 on c.accuser = u2.id";
if (isset($_POST["submit"])) {
  $query .=" where u.name = '".$_POST["geval"]."'";
}
$result = mysqli_query($db,$query) OR die("Query failed");
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr><th><form method=POST action=card_delete.php><input style=width:20px name=cardid value=$row[Cardid]></th><th>$row[Accused]</th><th>$row[Accuser]</th><td>$row[description]</td><th>$row[time]</th><td><input type=submit value=Delete></form>";
}
echo "</table>";
?>
