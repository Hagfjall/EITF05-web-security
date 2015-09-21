<?php
require_once "database.inc.php";
session_set_cookie_params(900, '/websec', 'localhost', false, true);
session_start();
//$db are from database.inc.php, already connected.
if ($db->isConnected()) {
    if(isset($_POST[email])){
        $_SESSION['email'] = $_POST[email];
        error_log('email:'. $_SESSION['email']);
    }
    $email = $_SESSION['email'];
    $password = $_POST['password'];

    $result = $db->authenticateUser($email, $password);
    if ($result == true || $_SESSION['auth']) {
        $_SESSION['auth'] = true;
        session_regenerate_id();
        showShop();
    } else {
        print 'FAIL';
    }

} else {
    echo 'Connection to database failed';
}
$db->closeConnection();


function showShop()
{
    global $db, $email;
    print 'SUCCESS';
    print "<br>Welcome " . $db->getName($email) . "!<br>";
    print "Here are the current exploits you can buy from us (shhh!!)!<br>";
    print '<form action="checkout.php" method="post" action="checkout.php">';
    print '<input type="checkbox" name="items" value="value1" />MS15-100 Microsoft Windows Media Center MCL Vulnerability<br />
        <input type="checkbox" name="items" value="value2" />Windows Escalate UAC Protection Bypass (ScriptHost Vulnerability)<br />
        <input type="checkbox" name="items" value="value3" />CMS Bolt File Upload Vulnerability<br />
        <input type="checkbox" name="items" value="value4" />Mac OS X "tpwn" Privilege Escalation<br />
        <input type="checkbox" name="items" value="value5" />Symantec Endpoint Protection Manager Authentication Bypass and Code Execution<br />
        <input type="checkbox" name="items" value="value6" />Heroes of Might and Magic III .h3m Map file Buffer Overflow<br />';
    print '<input type="submit" value="Buy">';
}

?>