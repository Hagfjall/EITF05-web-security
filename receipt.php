<?php
require_once "database.inc.php";
session_start();
print 'Thank you for your purchase! Here is the receipt.<br>';
$count = 0;
$items = $db->getAllItemsInShop();
for ($i = 0; $i < count($items); $i++) {
     if (isset($_SESSION['shopping_cart'][$i])) {
            print $_SESSION['shopping_cart'][$i].' "'.$items[$i].'" <br>';
        }
}