<html>
<?php
$title = "MANAGE RESULTS";
include('layouts/header.php');
include('fifadbconn.php');


$player = $_POST["players"];
$query = "SELECT id, homeplayer, awayplayer, homegoals, awaygoals FROM results WHERE homeplayer = '".$player."' ORDER BY id asc";
$result = mysqli_query($db, $query);

// Message
$printMessage = "";

if (!$result) {
    $printMessage = "Er zijn geen wedstrijden gevonden.<br>";
}
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"DennisGlobalCSSFIXER.css\">";

$printMessage .= "<h2>RESULT EDITOR</h2>" ;
echo "</br>";
?>
<br>
<div class="center-wrapper" style="width: 512px;">
    <?php echo $printMessage ?>
    <form action = "resultaanpas.php" method = "post">
        ID van de wedstrijd:<br> <input type="text" name = "Wed_ID"><br>
        Nieuw aantal doelpunten voor Home: <br> <input type="text" name = "Nieuw_Home"><br>
        Nieuw aantal doelpunten voor Away: <br> <input type="text" name= "Nieuw_Away" ><br>
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
