<?php
require_once "database.inc.php";
//$db are from database.inc.php, already connected.

// Only allow authenticated users to access the store page
if (! isset($_SESSION["auth"])) {
    header("Location: index.php");
}

$email = $_SESSION["email"];
$items = $db->getAllItemsInShop();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
<?php
require 'menu.php';
print "<br>Welcome " . $db->getName($email) . "!<br>";
print "Here are the current exploits you can buy from us (shhh!!)!<br>";
print '<form name="shop.php" method="post" action="shop.php">';
    for($i = 0; $i < count($items); $i++){
        print '<input type="submit" value="+" name="'.$i.'">'.$items[$i].'<br />';
    }
print '</form>';
echo '<br><br><br><br>';

$count = 0;
for ($i = 0; $i < count($items); $i++) {
    if (isset($_POST[$i])) {
        if (isset($_SESSION['shopping_cart'][$i])) {
            $_SESSION['shopping_cart'][$i]++;
        } else {
            $_SESSION['shopping_cart'][$i] = 1;
        }
        print 'You added "'.$items[$i].'" to the shopping cart!<br>';
    }
    if (isset($_SESSION['shopping_cart'][$i])) {
        $count += $_SESSION['shopping_cart'][$i];
    }
}

print 'number of items in shopping cart: ' . $count . "<br>";

?>
    </body>
</html>
