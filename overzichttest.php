<?php
// Database connectie met localhost
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; //alleen als er een wachtwoord is toegepast
$dbname = "fifa"; //naam van de database
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Test of de verbinding werkt!
if (mysqli_connect_errno()) {
die("De verbinding met de database is mislukt: " .
mysqli_connect_error() . " (" .
mysqli_connect_errno() . ")" );
};

$query = "SELECT * FROM players ORDER BY scores DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<table border=1>
<tr>
<td colspan=5><h2 align=center>Leaderboard</h2></td>
</tr><tr>
<th>Gebruikersnaam</th><th>Wachtwoord</th><th>Student#</th><th>Mailadres</th><th>Score</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>
<td><b>".$row['Playernames']."</td>
<td>".$row['Passwords']."</td>
<td>".$row['Studentcodes']."</td>
<td>".$row['Hanzemails']."</td>
<td><b>".$row['Scores']."</b></td>
</tr>";
};

mysqli_free_result($result);

mysqli_close($db);

?>
