<?php
require_once "database.inc.php";
session_start();
?>

Shopping Cart <br>
Items:<br>

<?php
    $items = $db->getAllItemsInShop();
for ($i = 0; $i < count($items); $i++) {
        if (isset($_SESSION['shopping_cart'][$i])) {
            print 'You have '.$_SESSION['shopping_cart'][$i].' "'.$items[$i].'" <br>';
        }
    }
?>
<br>
<a href="checkout.php">Checkout</a>


