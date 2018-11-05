<?php
include('header/header.php');
include('fifadbconn.php');

$ID = $_POST["Wed_ID"];
$nieuwhome = $_POST["Nieuw_Home"];
$nieuwaway = $_POST["Nieuw_Away"];
$query = "UPDATE results SET homegoals = $nieuwhome, awaygoals = $nieuwaway WHERE ID = $ID";

$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen wedstrijden gevonden.");
}

Echo "De resultaten zijn aangepast."
?>
