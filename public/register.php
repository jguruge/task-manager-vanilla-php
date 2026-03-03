<?php
session_start(); 
require_once "../models/User.php";

$message = "";

// Register user
if ($_SERVER["REQUEST_METHOD"] === "POST") { 

    $user = new User();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($user->register($name, $email, $password)) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

<div class="container">
    <div class="register-box">

        <h2>Create Account</h2>

        <?php if (!empty($message)) : ?>
            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>

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

            <button type="submit" class="btn">Register</button>

        </form>

        <p class="link">
            Already have an account? <a href="login.php">Login</a>
        </p>

    </div>
</div>

<!-- JS -->
<script src="assets/js/register.js"></script>

</body>
</html>