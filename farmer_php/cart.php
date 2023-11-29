<?php
session_start();

// Sample product data (replace with a database in a real application)
$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 800],
    ['id' => 2, 'name' => 'Smartphone', 'price' => 400],
    ['id' => 3, 'name' => 'Tablet', 'price' => 300],
];

function getProductById($productId, $products) {
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            return $product;
        }
    }
    return null;
}

function displayCart($cart, $products) {
    foreach ($cart as $productId => $quantity) {
        $product = getProductById($productId, $products);

        if ($product) {
            $subtotal = $product['price'] * $quantity;
            echo "<div class='cart-item'>
                    <h4>{$product['name']}</h4>
                    <p>Price: ${$product['price']}</p>
                    <p>Quantity: {$quantity}</p>
                    <p>Subtotal: ${$subtotal}</p>
                  </div>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $_POST['quantity'];
    } else {
        $_SESSION['cart'][$productId] += $_POST['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Shopping Cart</h2>
        
        <div class="content">
            <div class="cart-items">
                <?php displayCart($_SESSION['cart'], $products); ?>
            </div>

            <a href="index.php">Continue Shopping</a>
        </div>
    </div>
</body>
</html>
