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

$query = "SELECT * ";
$query .= "FROM players ";
$query .= "ORDER BY scores DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<table border=1>
<tr>
<td colspan=5><h2 align=center>Leaderboard</h2></td>
</tr><tr>
<th>Username</th><th>Password</th><th>Student#</th><th>Mailaddress</th><th>Score</th></tr>";
while ($row = mysqli_fetch_assoc($result)) { // Uitlezen van data opgehaald uit database
echo "<tr>
<td><b>".$row['playernames']."</td>
<td>".$row['passwords']."</td>
<td>".$row['studentcodes']."</td>
<td>".$row['hanzemails']."</td>
<td><b>".$row['scores']."</b></td>
</tr>";
};

mysqli_free_result($result); // Maakt $result array leeg

mysqli_close($db); // Verbreekt verbinding met database

?>
