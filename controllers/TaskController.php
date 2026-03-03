<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../models/Task.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Content-Type: application/json");


if (!isset($_SESSION['user_id'])) {
 echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$task = new Task();
$user_id = $_SESSION['user_id'];

$action = $_GET['action'] ?? '';
// GET
if ($action === "get") {
    $status = $_GET['status'] ?? null;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    $tasks = $task->getByUser($user_id, $status ?: null, $limit, $offset);
    echo json_encode($tasks);
    exit;
}
// CREATE
if ($action === "create") {
 $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
$task->create($user_id, $title, $description);
    echo json_encode(["message" => "Task created"]);
    exit;
}
// DELETE
if ($action === "delete") {
 $id = $_POST['id'] ?? 0;
$task->softDelete($id, $user_id);
    echo json_encode(["message" => "Task deleted"]);
    exit;
}
// UPDATE
if ($action === "update") {
 $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
 $task->update($id, $user_id, $title, $description, $status);
    echo json_encode(["message" => "Task updated"]);
    exit;
}

echo json_encode(["error" => "Invalid action"]);