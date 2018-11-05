<html>
<?php
include('header/header.php');
include('fifadbconn.php');

$user = $_POST["username"];
$query = "SELECT * FROM users WHERE name = '".$user."'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen gebruikers gevonden.");
}

echo "De volgende waarden zijn bij deze speler gevonden: " ;
echo "</br>";
?>
<table border ="1" width="30%">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Realname</th>
    <th>Password</th>
    <th>Score</th>
    <th>Highscore</th>
    <th>Email</th>
</tr>
<?php
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $row['id']  . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['realname'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['score'] . "</td>";
    echo "<td>" . $row['highscore'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>" ;
$user_id = $row['id'];
  }
$result->free();
?>
</table>
<br>
Selecteer wat je wilt aanpassen en vul de nieuwe waarde in: <form action ="gebruikeraanpas.php" method = "post">
<select name = "dropdown_value">
  <option value = "name"> Name </option>
  <option value = "realname"> Realname </option>
  <option value = "password"> Password </option>
  <option value = "score"> Score </option>
  <option value = "highscore"> Highscore </option>
  <option value = "email"> Email </option>
</select>
<input name = "id" value = "<?php echo $user_id; ?>">
<input type = "text" name = "update"><input type = "submit">
</form>
</html>
