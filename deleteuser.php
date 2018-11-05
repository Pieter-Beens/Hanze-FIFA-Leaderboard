<?php
include('fifadbconn.php');

$query = "DELETE FROM users WHERE name = " . "'$_POST[name]'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("De gebruiker kon niet verwijderd worden");
}

echo "De gebruiker is succesvol verwijderd.";

?>
