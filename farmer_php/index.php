<?php
session_start();

// Sample product data (replace with a database in a real application)
// Check if products are available in the session
if (isset($_SESSION['products'])) {
    $products = $_SESSION['products'];
} else {
    // Sample product data (replace with a database in a real application)
    $products = [
        ['id' => 1, 'name' => 'Laptop', 'price' => 800],
        ['id' => 2, 'name' => 'Smartphone', 'price' => 400],
        ['id' => 3, 'name' => 'Tablet', 'price' => 300],
    ];
}

function displayProducts($products) {
    foreach ($products as $product) {
        echo "<div class='product'>
                <h3>{$product['name']}</h3>
                <p>Price: {$product['price']}</p>
                <form method='post' action='cart.php'>
                    <input type='hidden' name='product_id' value='{$product['id']}'>
                    <input type='submit' value='Add to Cart'>
                </form>
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy and Sell Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to the Buy and Sell Website</h2>
        
        <div class="content">
            <div class="products">
                <h3>Available Products</h3>
                <?php displayProducts($products); ?>
            </div>

            <div class="forms">
                <div class="sell-form">
                    <h3>Sell Your Product</h3>
                    <form method="post" action="sell.php">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" required>

                        <label for="product_price">Product Price:</label>
                        <input type="number" id="product_price" name="product_price"  required>

                        <button type="submit">Sell</button>
                    </form>
                </div>

                <div class="buy-form">
                    <h3>Buy a Product</h3>
                    <form method='post' action='cart.php'>
                        <label for="product_id">Product ID:</label>
                        <input type='number' id='product_id' name='product_id' required>

                        <label for="quantity">Quantity:</label>
                        <input type='number' id='quantity' name='quantity' value='1' min='1' required>

                        <button type='submit'>Add to Cart</button>
                    </form>
                </div>
            </div>

            <a href="cart.php">View Cart</a>
        </div>
    </div>
</body>
</html>
