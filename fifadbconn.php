<?php
// Database connectie met STRATO server
$dbhost = "rdbms.strato.de";
$dbuser = "U3571439";
$dbpass = "Myx0mat0s!s"; //alleen als er een wachtwoord is toegepast
$dbname = "DB3571439"; //naam van de database
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Test of de verbinding werkt!
if (mysqli_connect_errno()) {
	// Als dat niet werkt probeert hij de localhost

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = ""; //alleen als er een wachtwoord is toegepast
	$dbname = "fifa"; //naam van de database
	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (mysqli_connect_errno()) {
		die("Failure connecting to the database: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
	};

};





?>
