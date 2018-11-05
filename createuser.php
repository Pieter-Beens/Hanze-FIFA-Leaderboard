<?php
include('fifadbconn.php');
include('layouts/header.php');

$query = "INSERT INTO users (name, realname, password, score, email, roles_id) VALUES ('$_POST[name]', '$_POST[realname]', '$_POST[password]', '$_POST[score]', '$_POST[email]', '1') ";
$result = mysqli_query($db, $query);

if (!$result) {
    die("De gebruiker kon niet aangemaakt worden");
}

echo "De gebruiker is succesvol aangemaakt.";

?>
