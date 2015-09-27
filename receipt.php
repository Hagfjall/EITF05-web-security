<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    	<?php require_once "database.inc.php"; ?>
    	<?php require_once "csrf.php"; ?>
		<?php require 'menu.php'; ?>

		<?php
			// Only allow checkout via HTTP POST requests (makes csrf easier)
			if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			    header("Location: checkout.php");
			    die();
			}

			// Enforce authentication
			if (!isset($_SESSION["auth"])) {
			    header("Location: index.php");
			    die();
			}

			if (!isset($_POST["csrf_token"])) {
				http_response_code(400);
				echo "err: no csrf token included in request";
				die();
			}

			$token = $_POST["csrf_token"];
			if (!validate_csrf("checkout_form", $token)) {
				http_response_code(400);
				echo "err: incorrect csrf token (validation error)";
				die();
			}

			$count = 0;
			$items = $db->getAllItemsInShop();
			for ($i = 0; $i < count($items); $i++) {
			    if (isset($_SESSION['shopping_cart'][$i])) {
			    	$count += $_SESSION['shopping_cart'][$i];
			        print $_SESSION['shopping_cart'][$i].' "'.$items[$i].'" <br>';
			    	
			    	unset($_SESSION["shopping_cart"][$i]);
			    }
			}

			if($count == 0){
			    print 'You need to purchase something in order to get a receipt...?';
			    die();
			}else {
			    print 'Thank you for your purchase! Above is the receipt.<br>';
			    print 'Your shooping cart has been emptied!';
			}
		?>
	</body>
</html>