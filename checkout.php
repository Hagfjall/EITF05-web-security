<?php
	require_once "database.inc.php";
	require_once 'csrf.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    	<?php require 'menu.php'; ?>

		<?php
			$count = 0;
			$items = $db->getAllItemsInShop();
			for ($i = 0; $i < count($items); $i++) {
				if (isset($_SESSION['shopping_cart'][$i])) {
			    	$count += $_SESSION['shopping_cart'][$i];
				}
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
		<form name="checkout_form" method="POST" action="receipt.php">
			<?php
				echo '<input type="hidden" name="csrf_token" value="'.init_csrf_token("checkout_form").'">';
			?>
			<input type="submit" value="transfer money (safe)">
		</form>
		<a href="receipt_unsafe.php">Transfer money (unsafe)</a>
	</body>
</html>