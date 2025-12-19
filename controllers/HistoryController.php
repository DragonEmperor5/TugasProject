<?php
include_once 'config/Database.php';

class HistoryController {
    private $conn;
    private $table_name = "history";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //fungsi untuk menyimpan riwayat hitungnya
    public function create($expression, $result) {
        $query = "INSERT INTO " . $this->table_name . " (expression, result) VALUES (:expression, :result)";
        $stmt = $this->conn->prepare($query);

    //membersihkan data (security)
    $expression = htmlspecialchars(strip_tags($expression));
    $result = htmlspecialchars(strip_tags($result));

    $stmt->bindParam(":expression", $expression); 
    $stmt->bindParam(":result", $result);

    if($stmt->execute()) {
        return true;
    }
    return false;
    }

    //fungsi untk mengambil semua riwayat
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fungsi hapus
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}