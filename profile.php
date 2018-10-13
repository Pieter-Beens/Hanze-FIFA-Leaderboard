<?php
include('fifadbconn.php');

echo "It's ".$_GET['user']."'s profile!";

$query = "SELECT * ";
$query .= "FROM results ";
$query .= "WHERE homeplayer =`".$_GET['user']."` OR awayplayer = `".$_GET['user']."`"
$query .= "ORDER BY `datetime` DESC";
$result = mysqli_query($db,$query) or die ('Error querying database');

echo "<table border=1>
<tr>
<td style=background-color:green;color:white colspan=7><h2 align=center>PLAYED MATCHES</h2></td>
</tr><tr style=background-color:lightblue>
<th>Date</th><th>Home Side</th><th colspan=2>Result</th><th>Away Side</th><th>Comment</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
  <td>".$row['datetime']."</td>
  <td>".$row['homeplayer']."</td>
  <td style=text-align:center><b>".$row['homegoals']."</b></td>
  <td style=text-align:center><b>".$row['awaygoals']."</b></td>
  <td style=text-align:right>".$row['awayplayer']."</td>
  <td>".$row['description']."</td>
  </tr>";
}

echo "</table>";

?>
