<?php
// Database connectie met localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; //alleen als er een wachtwoord is toegepast
$dbname = "fifa"; //naam van de database
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test of de verbinding werkt!
if (mysqli_connect_errno()) {
die("Failure connecting to the database: " .
mysqli_connect_error() . " (" .
mysqli_connect_errno() . ")" );
};

?>
