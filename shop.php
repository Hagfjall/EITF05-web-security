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
        die();
    }

} else {
    echo 'Connection to database failed';
}
$db->closeConnection();


function showShop()
{
    global $db, $email;
    $items = $db->getAllItemsInShop();
    print "<br>Welcome " . $db->getName($email) . "!<br>";
    print "Here are the current exploits you can buy from us (shhh!!)!<br>";
    print '<form name="shop.php" method="post" action="shop.php">';
        for($i = 0; $i < count($items); $i++){
            print '<input type="submit" value="+" name="'.$i.'">'.$items[$i].'<br />';
        }
    print '</form> <a href="shopping_cart.php">Go to shopping cart</a><br><br><br><br> ';

    $count = 0;
    for ($i = 0; $i < count($items); $i++) {
        if (isset($_POST[$i])) {
            $_SESSION['shopping_cart'][$i]++;
            print 'You added "'.$items[$i].'" to the shopping cart!<br>';
        }
        $count += $_SESSION['shopping_cart'][$i];
    }

    print 'number of items in shopping cart: ' . $count . "<br>";
}

?>