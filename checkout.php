<?php
require_once "database.inc.php";
session_start();

$count = 0;
$items = $db->getAllItemsInShop();
for ($i = 0; $i < count($items); $i++) {
    $count += $_SESSION['shopping_cart'][$i];
}
if ($count == 0){
    print "You have no exploits in your shopping cart";
    print '<a href="shop.php">Go back</a>';
    die();
} else {
    print "Transfer ";
    print $count;
    print " bitcoins to bitcoin account 999999999 to purchase";
}
?>
<br>
<a href="receipt.php">Transfer money</a>

