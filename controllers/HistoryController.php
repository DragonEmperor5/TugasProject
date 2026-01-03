<?php
require_once 'config/Database.php';

class HistoryController {
    private $conn;
    private $table_name = "history";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //fungsi untk mengambil semua riwayat
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    //fungsi hapus
    public function clear() {
        $query = "TRUNCATE TABLE " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>