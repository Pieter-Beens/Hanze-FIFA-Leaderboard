<?php
//include('header/header.php');
include('fifadbconn.php');

$id = $_POST['id'];
$dropdownvalue = $_POST['dropdown_value'];
$update = $_POST['update'];
$query = "UPDATE users SET '$dropdownvalue' = '$update' WHERE id = $id";

$result = mysqli_query($db, $query);

if (!$result) {
    die("De gegevens konden niet aangepast worden");
}

echo "De gegevens zijn succesvol aangepast";
?>
