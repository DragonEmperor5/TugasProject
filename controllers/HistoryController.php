<?php
require_once 'config/Database.php';

class HistoryController {
    private $conn;
    private $table_name = "history";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Di dalam file HistoryController.php

public function readByCategory($category) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE category = :category ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt;
}

public function clearByCategory($category) {
    $query = "DELETE FROM " . $this->table_name . " WHERE category = :category";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category', $category);
    return $stmt->execute();
}
}
?>