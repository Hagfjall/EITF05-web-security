<?php
require_once "database.inc.php";
?>

Shopping Cart <br>
Items:<br>

<?php
    $items = $db->getAllItemsInShop();
for ($i = 0; $i < count($items); $i++) {
        if (isset($_SESSION['shopping_cart'][$i])) {
        	$in_cart = $_SESSION['shopping_cart'][$i];
        	if ($in_cart > 0) {
            	print 'You have '.$in_cart.' "'.$items[$i].'" <br>';
        	}
        }
    }
?>
<br>
<a href="checkout.php">Checkout</a>


