<?php
require_once "database.inc.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<form name="login_form" method="post" action="shop.php">
    Email:<br>
    <input type="text" name="email" class="input">
    <br>
    Password:<br>
    <input type="password" name="password" class="input">
    <br>
    <input type="submit" value="Login">
</form>
<a href="signup_form.html">Sign up</a>
<br>
All the users that bought amazing expl0itz from us!<br>
<div id="tableTag"></div>
<script src="js/index.js"></script>
</body>
</html>