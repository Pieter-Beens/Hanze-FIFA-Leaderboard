<html>
<?php
include('header/header.html');
include('fifadbconn.php');

$player = $_POST["players"];
$query = "SELECT id, homeplayer, awayplayer, homegoals, awaygoals FROM results WHERE id = '".$player."' ORDER BY id asc";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
if (!$result) {die("Er zijn geen wedstrijden gevonden.");}


echo "Selecteer de wedstrijd die die speler heeft gespeeld:" ;
echo "</br>";
?>
<table border ="1" width="30%" align = "left">
  <tr>
    <td colspan="4"> <h2 align="center"> Overzicht Wedstrijden </h2></td>
  </tr>
<tr><th> </th><th>ID</th><th>Homeplayer</th><th>Awayplayer</th><th>Homegoals</th><th>Awaygoals</th> </tr>
<?php while ($result = mysqli_fetch_assoc($result)){
  print_r ($result);
echo "<tr>";
echo "<td>" . $result['id']  . "</td>";
echo "<td>" . $result['homeplayer'] . "</td>";
echo "<td>" . $result['awayplayer'] . "</td>";
echo "<td>" . $result['homegoals'] . "</td>";
echo "<td>" . $result['awaygoals'] . "</td>";
}
?>
</table>
</html>
