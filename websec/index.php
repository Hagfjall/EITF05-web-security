<?php
require_once "database.inc.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require 'menu.php'; ?>
<?php
    if (isset($_SESSION["auth"])) {
        print "<h3>welcome back, ".$_SESSION["email"]."!</h3>";
    } else {
    ?>
    <form name="login_form" method="post" action="login.php">
        Email:<br>
        <input type="text" name="email" class="big">
        <br>
        Password:<br>
        <input type="password" name="password" class="big">
        <br>
        <input type="submit" value="Login" class="big">
    </form>
    <?php
    }
?>
<br>
All the users that bought amazing expl0itz from us!<br>
<div id="tableTag"></div>
<script src="js/index.js"></script>
</body>

</html>