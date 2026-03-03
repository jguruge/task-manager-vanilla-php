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

// login form
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <p><?= $message ?></p>

    <a href="register.php">Register Here</a>
</body>
</html>