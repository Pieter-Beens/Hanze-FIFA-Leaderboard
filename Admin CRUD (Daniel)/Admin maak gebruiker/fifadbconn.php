<?php
// Database connectie met localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; //alleen als er een wachtwoord is toegepast
$dbname = "fifa"; //naam van de database
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test of de verbinding werkt! (Voor die smerige XAMP)
if (mysqli_connect_errno()) {
	// Als dat niet werkt probeert hij mijn settings zodat mijn database ook werkt niet aanpassen A U B -Dennis

	// Database connectie met localhost
	$dbpass = "usbw"; // zet wachtwoord voor mijn server (is verplicht bij usbwebserver)
	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Test of de verbinding werkt! (Voor die geweldige usbwebserver 8.6.2)
	if (mysqli_connect_errno()) {
		die("Failure connecting to the database: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
	};

};
?>
