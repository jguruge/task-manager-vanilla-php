<?php
session_start();
require_once "../models/User.php";

$message = "";

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
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>

    <p><?= $message ?></p>

    <a href="login.php">Login Here</a>
</body>
</html>