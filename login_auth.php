<?php
require_once "database.inc.php";
$database = new Database('localhost', 'root', 'root', 'websecurity');

$database->openConnection();
if ($database->isConnected()) {
    $email = $_POST[email];
    $password = $_POST[password];
    $result = $database->authenticateUser($email, $password);
    if ($result == true) {
        showShop();
    } else {
        print 'FAIL';
    }

} else {
    echo 'Connection to database failed';
}
$database->closeConnection();


function showShop()
{
    global $database, $email;
    print 'SUCCESS';
    print "<br>Welcome " . $database->getName($email) . "!<br>";
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