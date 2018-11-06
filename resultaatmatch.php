<html>
<?php
$title = "Math results editor";
include('layouts/header.php');
include('fifadbconn.php');


$player = $_POST["players"];
$query = "SELECT id, homeplayer, awayplayer, homegoals, awaygoals FROM results WHERE homeplayer = '".$player."' ORDER BY id asc";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen wedstrijden gevonden.");
}
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"DennisGlobalCSSFIXER.css\">";

echo "Selecteer de wedstrijd die die speler heeft gespeeld:" ;
echo "</br>";
?>

<div class="center-wrapper" style="width: 512px;">
    <form action = "resultaanpas.php" method = "post">
        Vul de ID van de wedstrijd in:<br> <input type="text" name = "Wed_ID"><br>
        Vul de Nieuwe score van Homeplayer in<br> <input type="text" name = "Nieuw_Home"><br>
        Vul de Nieuwe score van Awayplayer in<br> <input type="text" name= "Nieuw_Away" ><br>
        <input type = "submit" style="float: none;">
    </form>
</div>

<div class="center-wrapper" style="width: 100%; max-width: 1024px; height:768px; background-color: transparent; border: solid 0px white;">
<table border ="1" width="100%" align = "left">
    <tr>
        <td colspan="4"> <h2 align="center"> Overzicht Wedstrijden </h2></td>
    </tr>
<tr>
    <th>ID</th>
    <th>Homeplayer</th>
    <th>Awayplayer</th>
    <th>Homegoals</th>
    <th>Awaygoals</th>
</tr>
<tr>

<?php
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row['id']  . "</td>";
    echo "<td>" . $row['homeplayer'] . "</td>";
    echo "<td>" . $row['awayplayer'] . "</td>";
    echo "<td>" . $row['homegoals'] . "</td>";
    echo "<td>" . $row['awaygoals'] . "</td>";
    echo "</tr>";
  }
$result->free();
?>
</tr>
</table>
</div>

</html>
