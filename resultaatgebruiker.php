
<?php
include('header.php');
include('fifadbconn.php');

$user = $_POST["users"];
$query = "SELECT id, name FROM users WHERE name = '".$user."'";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Er zijn geen gebruikers gevonden.");
}

while ($row = $result->fetch_assoc()){
$user_id =  $row['id'];
echo "De ID van $user is $user_id" . '</br>';
  }
?>
