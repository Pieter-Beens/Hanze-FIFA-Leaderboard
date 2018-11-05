<?php
include('layouts/header.php');
include('fifadbconn.php');

$query = "DELETE FROM users WHERE name = " . "'$_POST[name]'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("De gebruiker is niet gevonden");
}

echo "De gebruiker is succesvol verwijderd.";

?>
