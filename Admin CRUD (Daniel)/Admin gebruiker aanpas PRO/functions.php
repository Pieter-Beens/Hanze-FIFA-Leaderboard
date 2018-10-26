<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 25/10/2018
 * Time: 17:36
 */

$dbh = initDb();

function initDb()
{
	$config = parse_ini_file(__DIR__ . '/config.ini', true);
	if (($dbh = mysqli_connect($config['db']['host'], $config['db']['username'], $config['db']['password'])) === false)
		throw new Exception(mysqli_connect_error());
	if (!mysqli_select_db($dbh, $config['db']['database']))
		throw new Exception(mysqli_error($dbh));
	return $dbh;
}

function doQuery($query)
{
	global $dbh;

	if (($res = mysqli_query($dbh, $query)) === false)
		throw new Exception(mysqli_error($dbh));

	return $res;
}

function getAllEntries(): array
{
	return mysqli_fetch_all(doQuery("SELECT * FROM users"), MYSQLI_ASSOC);

}

function getEntry($id): array
{
	$res = doQuery("SELECT * FROM users WHERE id = " . intval($id));
	if (mysqli_num_rows($res) == 0)
		throw new Exception("Entry met $id bestaat niet");

	return mysqli_fetch_assoc($res);
}

function createLabel($name, $label, $value): string
{
	return <<<EOL
<label for="$name">$label</label>
<input id="$name" name="$name" value="$value">

EOL;

}

function createUpdateForm($id): string
{
	$entry = getEntry($id);
	$form = "<form method=\"POST\" action=\"do_update.php\">";

	$formInfo = [
		'name' => 'Naam',
		'realname' => 'Echte naam',
		'password' => 'Wachtwoord',
		'score' => 'Score',
		'highscore' => 'Highscore',
		'email' => 'email',
	];

	foreach ($formInfo as $dbField => $description)
		$form .= createLabel($dbField, $description, $entry[$dbField]) . "<br>\n";
	$form .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
	$form .= "<input type=\"submit\">";
	$form .= "</form>";

	return $form;
}

function doUpdate($id, array $newValues)
{
	global $dbh;

	// Unset, omdat deze anders meekomt in het SET-deel.
	unset($newValues['id']);

	$query = "UPDATE users SET ";

	$queryParts = [];
	foreach ($newValues as $field => &$value)
	{
		// Nooit input van 'externen' vertrouwen, en daarom altijd een escape doen.
		// Google ook op SQL injection.
		$queryParts[] = '`' . mysqli_escape_string($dbh, $field) . "` = '" . mysqli_escape_string($dbh, $value) . "'";
	}

	// Formeer de SET-delen van de query.
	$query .= join(', ', $queryParts);
	$query .= " WHERE id = " . intval($id);

	doQuery($query);
}
