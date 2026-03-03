
<?php

class Database {

    // Database details
    private $host = "localhost";
    private $database_name = "task_manager";
    private $username = "root";
    private $password = "";

    public function connect() {
        $connection = null;

        try {

            // Create PDO connection
            $connection = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database_name,
                $this->username,
                $this->password
            );
            // Set error 
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $error) {

            echo "Database Connection Failed: " . $error->getMessage();
        }

        return $connection;
    }
}