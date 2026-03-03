<?php

require_once __DIR__ . '/../config/database.php';

$database = new Database();
$pdo = $database->connect();

if ($pdo) {
    echo "Database connected successfully!";
}
else{
    echo "Failed to connect to database.";
}