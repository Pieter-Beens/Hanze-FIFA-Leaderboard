<html>
<head>
	<title>Update <?php echo $_GET['id']; ?></title>
</head>
<body>

<?php
require_once __DIR__ . '/functions.php';

echo createUpdateForm($_GET['id']);

?>
</body>
</html>