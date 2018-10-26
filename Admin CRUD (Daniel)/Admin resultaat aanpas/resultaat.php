<html>
<?php
include('header/header.html');
include('fifadbconn.php');

$player = $_POST["players"];
$query = "SELECT id, homeplayer, awayplayer, homegoals, awaygoals FROM results WHERE homeplayer = '".$player."' ORDER BY id asc";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen wedstrijden gevonden.");
}

echo "Selecteer de wedstrijd die die speler heeft gespeeld:" ;
echo "</br>";
?>
<table border ="1" width="30%" align = "left">
    <tr>
        <td colspan="4"> <h2 align="center"> Overzicht Wedstrijden </h2></td>
    </tr>
<tr>
  <th></th>
    <th>ID</th>
    <th>Homeplayer</th>
    <th>Awayplayer</th>
    <th>Homegoals</th>
    <th>Awaygoals</th>
</tr>
<tr>
<?php
while ($row = $result->fetch_assoc()){
    echo "<td> <input type = 'radio' value = ".$row['id']." name = 'selectie'> </td>";
    echo "<td>" . $row['id']  . "</td>";
    echo "<td>" . $row['homeplayer'] . "</td>";
    echo "<td>" . $row['awayplayer'] . "</td>";
    echo "<td>" . $row['homegoals'] . "</td>";
    echo "<td>" . $row['awaygoals'] . "</td>";
}

$result->free();
?>
</tr>
</table>
</html>
