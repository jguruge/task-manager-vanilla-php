<?php
// Start session and handle login logic
session_start();
require_once "../models/User.php";



$message = "";

// Login user
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user = new User(); // Create User instance

    $email = $_POST["email"]; // Get email and password
    $password = $_POST["password"];

    if ($user->login($email, $password)) { // Attempt login
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="container">
    <div class="login-box">

        <h2>Login</h2>

        <?php if (!empty($message)) : ?>
            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" onclick="togglePassword()">Show</button>
                </div>
            </div>

            <button type="submit" class="btn">Login</button>

        </form>

        <p class="link">
            Don't have an account? <a href="register.php">Register</a>
        </p>

    </div>
</div>

<!-- JS -->
<script src="assets/js/login.js"></script>

</body>
</html>