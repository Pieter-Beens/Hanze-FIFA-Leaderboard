<?php
//include('fifadbconn.php');
//$player = $_POST["players"];
//$r = $db->query("SELECT * FROM results WHERE homeplayer = '" . $player . "'");
//$r->fetch_object();
//
//foreach ($r as $r){
//    echo "<tr>";
//    echo "<td>" . $r['id'] . "</td><br>";
//    echo "<td>" . $r['homeplayer'] . "</td><br>";
//    echo "<td>" . $r['awayplayer'] . "</td><br>";
//    echo "<td>" . $r['homegoals'] . "</td><br>";
//    echo "<td>" . $r['awaygoals'] . "</td><br>";
//}
//
//die()
//?>

<html>
<?php
include('header/header.php');
include('fifadbconn.php');

$player = $_POST["players"];
$query = "SELECT * FROM results WHERE homeplayer = '" . $player . "'";
$result = mysqli_query($db, $query);
$result->fetch_object();
//$row = mysqli_fetch_assoc($result);
//print_r($row);
if (!$result) {
    die("Er zijn geen wedstrijden gevonden.");
}

echo "Selecteer de wedstrijd die die speler heeft gespeeld:";
echo "</br>";
?>
<table border="1" width="30%" align="left">
    <tr>
        <td colspan="4"><h2 align="center"> Overzicht Wedstrijden </h2></td>
    </tr>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Homeplayer</th>
        <th>Awayplayer</th>
        <th>Homegoals</th>
        <th>Awaygoals</th>
    </tr>
    <?php

    foreach (mysqli_fetch_assoc($result) as $row) {}

    while ($result = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $result['id'] . "</td>";
        echo "<td>" . $result['homeplayer'] . "</td>";
        echo "<td>" . $result['awayplayer'] . "</td>";
        echo "<td>" . $result['homegoals'] . "</td>";
        echo "<td>" . $result['awaygoals'] . "</td>";
    }
    ?>
</table>
</html>
