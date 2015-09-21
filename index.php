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
</body>
<br>
All the users that bought amazing expl0itz from us!<br>
<b>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Address<br>
</b><br>
<?php
$result = $db->getAllUsers();
foreach ($result as $user) {
    print $user['email']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print $user['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print $user['address']."<br>";
//    print_r($user);
    print'<br>';
}
//print_r($result);

?>

</html>