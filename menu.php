<?php
	echo '<div class="menu">
		<a href="index.php">home</a> ';
	if (isset($_SESSION["auth"])) {
		echo '<a href="shop.php">shop</a>
		<a href="shopping_cart.php">cart</a>
		<a href="logout.php">logout</a>';
	} else {
		echo '<a href="index.php">login</a>
		<a href="signup_form.html">sign up</a>';
	}
	echo '</div>';
?>