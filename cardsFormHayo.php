<?php
Include_once('layouts/header.php');
include_once('core/init.php');
include_once('fifadbconn.php');
?>
<form class="" action="" method="post">
  Probleem Kind zoeken:</br><input type="text" name="geval" value="">
  <input type="submit" name="submit" value="submit">
</form>
<style>
table{
  border-collapse: collapse;
  font-family: sans-serif;
}
td,tr {
    text-align:center;
}
tr:nth-child(even){
  background-color: rgba(0, 0, 0, 0.40);
}
</style>
<table>
<tr><th>card id</th><th>Accused</th><th>Accuser</th><th>Description</th><th>Date and time</th>
<?php
$query = "select c.id As 'Cardid' , u.name as Accused , u2.name as Accuser, c.description, c.datetime as 'time'";
$query .= "from cards c join users u on c.accused = u.id join users u2 on c.accuser = u2.id";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr><th>$row[Cardid]</th><th>$row[Accused]</th><th>$row[Accuser]</th><th>$row[description]</th><th>$row[time]</th>";
}
echo "</table>";
?>
