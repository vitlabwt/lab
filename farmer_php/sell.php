<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sample product data (replace with a database in a real application)
    $products = [
        ['id' => 1, 'name' => 'Laptop', 'price' => 800],
        ['id' => 2, 'name' => 'Smartphone', 'price' => 400],
        ['id' => 3, 'name' => 'Tablet', 'price' => 300],
    ];

    // Get user input
    $productName = $_POST['product_name'];
    $productPrice = floatval($_POST['product_price']);

    // Add the new product to the list
    $newProduct = ['id' => count($products) + 1, 'name' => $productName, 'price' => $productPrice];
    $products[] = $newProduct;
echo '<h1>{$products}<h1/>';
    // Update the product list in the session
    $_SESSION['products'] = $products;
}

// Redirect back to the index page
header("Location: index.php");
exit();
?>
