<?php

include 'auth.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
</head>
<body>
    <h2>Shopping Cart</h2>

    <?php
    if (!empty($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $cart_item) {
            echo "<div class='cart-item'>
                    <p>Tour ID: {$cart_item["tour_id"]}</p>
                    <p>Number of Travelers: {$cart_item["num_travelers"]}</p>
                  </div>";
        }
    } else {
        echo "Your cart is empty.";
    }
    ?>

    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
