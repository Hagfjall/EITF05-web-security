<?php
require_once "database.inc.php";

$result = $db->getAllUsers();

header('Content-Type: application/json');
print json_encode($result);
?>