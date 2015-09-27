<?php
require_once "database.inc.php";

// Only allow login via HTTP POST requests
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php");
}

// We cannot log in twice using the same session
if (isset($_SESSION["auth"])) {
    echo "already logged in!";
    die();
}

// POST request must have the required credentials for logging in
if (!isset($_POST["email"]) or !isset($_POST["password"])) {
    echo "post body must have email and password fields";
    die();
}

// We authenticate using database-stored credentials, so if
// connection to database fails... bail fast af
if (!$db->isConnected()) {
    echo "couldn't contact database";
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

$success = $db->authenticateUser($email, $password);

if (!$success) {
    echo "invalid credentials";
    die();
}

// It shouldn't matter if the attacker acquires the 
// user's pre-auth session token.
session_regenerate_id();
$_SESSION["auth"] = true;
$_SESSION["email"] = $email;
$_SESSION['shopping_cart'] = array();
header("Location: shop.php");

$db->closeConnection();
?>