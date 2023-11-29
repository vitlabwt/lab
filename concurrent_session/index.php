<?php
session_start();

// Function to check and limit concurrent logins
function checkConcurrentLogins($maxConcurrentLogins = 3) {
    if (!isset($_SESSION['login_count'])) {
        $_SESSION['login_count'] = 1;
    } else {
        $_SESSION['login_count']++;
    }

    if ($_SESSION['login_count'] > $maxConcurrentLogins) {
        // Too many concurrent logins, deny access
        session_destroy();
        die("Sorry, you've reached the maximum number of concurrent logins.");
    }
}

// Check concurrent logins when the user tries to login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkConcurrentLogins();

    // Your login validation logic here
    // For demonstration purposes, I'm just redirecting to a welcome page
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <!-- Your login form fields go here -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
