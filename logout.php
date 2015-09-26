<?php
// Use same session setup as other pages
require_once "database.inc.php";

if (!isset($_SESSION["auth"])) {
	header("Location: index.php");
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
	<head>
	    <link rel="stylesheet" href="style.css">
	</head>

	<body>
		<h1>success</h1>
		<p>you were successfully logged out!</p>
		<a href="index.php">go back</a>
	</body>
</html>