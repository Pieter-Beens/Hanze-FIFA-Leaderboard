<html>
<head>
	<title>Overzicht</title>
</head>
<body>
<table border="1">
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
	require_once __DIR__ . '/functions.php';

	foreach (getAllEntries() as $entry)
	{
		echo<<<EOL
<tr>
		<td><a href="update.php?id={$entry['id']}">{$entry['id']}</a></td>
		<td>{$entry['name']}</td>
		<td>{$entry['realname']}</td>
		<td>{$entry['password']}</td>
		<td>{$entry['score']}</td>
		<td>{$entry['highscore']}</td>
		<td>{$entry['email']}</td>
</tr>
EOL;

	}
	?>
</table>
</body>
</html>
<?php
