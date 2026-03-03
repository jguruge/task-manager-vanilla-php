<?php
require_once __DIR__ . "/../config/database.php";

class Task {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create Task
    public function create($user_id, $title, $description) {

        $stmt = $this->conn->prepare(
            "INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)"
        );

        return $stmt->execute([$user_id, $title, $description]);
    }

    // Get All Tasks 
public function getByUser($user_id, $status = null, $limit = 5, $offset = 0) {

    $sql = "SELECT * FROM tasks 
            WHERE user_id = ? 
            AND deleted_at IS NULL";

    if ($status) {
        $sql .= " AND status = ?";
    }

    $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";

    $stmt = $this->conn->prepare($sql);

    $paramIndex = 1;
    $stmt->bindValue($paramIndex++, $user_id, PDO::PARAM_INT);

    if ($status) {
        $stmt->bindValue($paramIndex++, $status, PDO::PARAM_STR);
    }

    $stmt->bindValue($paramIndex++, (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue($paramIndex++, (int)$offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Soft Delete Task
    public function softDelete($task_id, $user_id) {

        $stmt = $this->conn->prepare(
            "UPDATE tasks 
             SET deleted_at = NOW() 
             WHERE id = ? AND user_id = ?"
        );

        return $stmt->execute([$task_id, $user_id]);
    }

    
public function update($task_id, $user_id, $title, $description, $status) {

    $stmt = $this->conn->prepare(
        "UPDATE tasks 
         SET title=?, description=?, status=? 
         WHERE id=? AND user_id=? AND deleted_at IS NULL"
    );

    return $stmt->execute([$title, $description, $status, $task_id, $user_id]);
}


}


