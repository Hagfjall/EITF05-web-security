<?php
require_once "database.inc.php";
session_set_cookie_params(900, '/websec', 'localhost', false, true);
session_start();
//$db are from database.inc.php, already connected.
if ($db->isConnected()) {
    $email = $_POST[email];
    $password = $_POST['password'];

    $result = $db->authenticateUser($email, $password);
    if ($result) {
//        session_regenerate_id(FALSE);
        session_unset();
    }
    if ($result == true || $_SESSION['auth']) {
        $_SESSION['auth'] = true;
        if (!empty($email)) {
            $_SESSION['email'] = $email;
        } else {
            $email = $_SESSION['email'];
        }
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
    print '<form name="shop.php" method="post" action="shop.php">';
    print '<input type="submit" value="+" name="0" action="shop.php">MS15-100 Microsoft Windows Media Center MCL Vulnerability<br />
        <input type="submit" value="+" name="1">Windows Escalate UAC Protection Bypass (ScriptHost Vulnerability)<br />
        <input type="submit" value="+" name="2">CMS Bolt File Upload Vulnerability<br />
        <input type="submit" value="+" name="3">Mac OS X "tpwn" Privilege Escalation<br />
        <input type="submit" value="+" name="4">Symantec Endpoint Protection Manager Authentication Bypass and Code Execution<br />
        <input type="submit" value="+" name="5">Heroes of Might and Magic III .h3m Map file Buffer Overflow<br />';
    print '</form> <a href="shopping_cart">Go to shopping cart</a><br><br><br><br> ';


    $count = 0;
    for ($i = 0; $i < 6; $i++) {
        if (isset($_POST[$i])) {
            $_SESSION['shopping_cart'][$i]++;
            print 'You added an expl0it to the shopping cart!' . "<br>";
        }
        $count += $_SESSION['shopping_cart'][$i];
    }

    print 'number of items in shopping cart: ' . $count . "<br>";
}

?>