<html>
<head>
   <?php include('layouts/header.php'); ?>
</head><?php
include('fifadbconn.php');

$query = "SELECT id, name, realname FROM users ORDER BY name ASC";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen gebruikers gevonden.");
}

?>
<table border ="1" width="30%" align = "left">
    <tr>
        <td colspan="4"> <h2 align="center"> Overzicht Gebruikers </h2></td>
    </tr>
<tr>
    <th>ID</th>
    <th>Speler</th>
    <th>Echte naam</th>
</tr>
<tr>
<?php
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row['id']  . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['realname'] . "</td>";
    echo "</tr>";
  }
$result->free();
?>
</tr>
</table>
</html>
