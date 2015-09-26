<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
		<?php require 'menu.php'; ?>

		<?php
			require_once "database.inc.php";
			$count = 0;
			$items = $db->getAllItemsInShop();
			for ($i = 0; $i < count($items); $i++) {
			    if (isset($_SESSION['shopping_cart'][$i])) {
			    	$count += $_SESSION['shopping_cart'][$i];
			        print $_SESSION['shopping_cart'][$i].' "'.$items[$i].'" <br>';
			    }
			}
			if($count == 0){
			    print 'You need to purchase something in order to get a receipt...?';
			    die();
			}else {
			    print 'Thank you for your purchase! Above is the receipt.<br>';
			}
		?>
	</body>
</html>