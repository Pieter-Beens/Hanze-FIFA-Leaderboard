<html>
<head>
   <?php $title = "Manage Users";
   include('layouts/header.php'); ?>
</head><?php
include('fifadbconn.php');

$query = "SELECT id, name, realname, email FROM users ORDER BY name ASC";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen gebruikers gevonden.");
}

?>


<link rel="stylesheet" type="text/css" href="DennisGlobalCSSFIXER.css">
<br><br>
<div class="center-wrapper" style="width: 512px;">

<form style=text-align:center action = "resultaatgebruiker.php" method = "post"><br>
<h2>Input name to find player ID</h2>
<input type="text" name = "users"><br>
<input type = "submit" value = "Find ID" style="float: none;">
</form>
</div>
<br>

<hr>
<p style=color:orange;font-size:18pt;text-align:center>
<a style=color:orange href=maakgebruiker.php>CREATE USER</a><br>
<a style=color:orange href=zoekgebruiker2.php>EDIT USER</a><br>
<a style=color:orange href=verwijdergeb.php>DELETE USER</a><br><p>

<table border ="1" width="80%" align = "center">
    <tr>
        <td colspan="4"> <h2 align="center">USERS OVERVIEW</h2></td>
    </tr>
<tr>
    <th>ID</th>
    <th>Player</th>
    <th>Real Name</th>
    <th>Email</th>
</tr>
<tr>
<?php
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row['id']  . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['realname'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
  }
$result->free();
?>
</tr>
</table><br>
