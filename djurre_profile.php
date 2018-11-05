<style>
    table, th, td {
        border: 1px solid black;
    }
</style>

<?php
require_once 'core/init.php';

if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if (!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
    } ?>

    <h3><?php echo escape($data->name) ?></h3>
    <p>Name: <?php echo escape($data->realname) ?></p>
    <p>Email: <?php echo escape($data->email) ?></p>

    <?php
}

$conn = mysqli_connect('localhost', 'root', '', 'fifa');
$users = mysqli_query($conn, "SELECT * FROM users");

?>
<table style="width:100%">
    <tr>
        <th>Name</th>
        <th>Realname</th>
        <th>score</th>
        <th>highscore</th>
        <th>email</th>
        <th>joindate</th>
    </tr>
    <?php
    while ($obj = mysqli_fetch_object($users)) {
        echo '<tr>';
        echo '<td>' . $obj->name . '</td>';
        echo '<td>' . $obj->realname . '</td>';
        echo '<td>' . $obj->score . '</td>';
        echo '<td>' . $obj->highscore . '</td>';
        echo '<td>' . $obj->email . '</td>';
        echo '<td>' . $obj->joindate . '</td>';
        echo '<tr>';
    }
    ?>
</table><br><br>

<?php

$results = mysqli_query($conn, "SELECT * FROM results");

?>
<table style="width:100%">
    <tr>
        <th>Home player</th>
        <th>Away player</th>
        <th>Home goals</th>
        <th>Away goals</th>
        <th>Desription</th>
        <th>Date</th>
    </tr>
    <?php
    while ($obj = mysqli_fetch_object($results)) {
        echo '<tr>';
        echo '<td>' . $obj->homeplayer . '</td>';
        echo '<td>' . $obj->awayplayer . '</td>';
        echo '<td>' . $obj->homegoals . '</td>';
        echo '<td>' . $obj->awaygoals . '</td>';
        echo '<td>' . $obj->description . '</td>';
        echo '<td>' . $obj->datetime . '</td>';
        echo '<tr>';
    }
    ?>
</table>