<?php
/*
==========================================
Bagian Controller (Penghubung)
File ini bertugas mengatur alur data antara Database dan Tampilan (View).
==========================================
*/
//memanggil file konfigurasi database agar bisa melakukan koneksi
require_once 'config/Database.php';

class HistoryController {
    //properti untuk menyimpan objek koneksi database
    private $conn;
    
    //mama tabel di database yang akan diolah oleh class ini
    private $table_name = "history";

    //! Constructor
    //fungsi yang otomatis jalan pertama kali saat class ini dipanggil (new HistoryController)
    public function __construct() {
        //membuat objek Database baru
        $database = new Database();
        
        //membuka koneksi ke MySQL dan menyimpannya ke variabel $this->conn
        $this->conn = $database->getConnection();
    }

    //! Fungsi 1: Membaca Data Berdasarkan Kategori
    //dipanggil untuk menampilkan list history di panel kanan
    //parameter $category bisa berisi 'biasa' atau 'suhu'
    public function readByCategory($category) {
        
        //menyiapkan query SQL:
        //ambil semua data DARI tabel history di mana category sesuai input
        //urutkan dari ID terbesar (data terbaru paling atas)
        $query = "SELECT * FROM " . $this->table_name . " WHERE category = :category ORDER BY id DESC";
        
        //menyiapkan statement PDO (Langkah keamanan standar)
        $stmt = $this->conn->prepare($query);
        
        //mengikat (Binding) parameter :category dengan nilai asli variabel $category
        //ini mencegah hacker melakukan SQL Injection
        $stmt->bindParam(':category', $category);
        
        //menjalankan query ke database
        $stmt->execute();
        
        //mengembalikan hasil data mentah ke pemanggil fungsi ini
        return $stmt;
    }

    //! Fungsi 2: Menghapus Data Berdasarkan Kategori
    //dipanggil saat tombol "Hapus Riwayat" ditekan
    public function clearByCategory($category) {
        
        //menyiapkan query SQL HAPUS:
        //hapus DARI tabel history DI MANA category sesuai input
        //(Jadi kalau hapus history suhu, history matematika biasa tidak ikut terhapus)
        $query = "DELETE FROM " . $this->table_name . " WHERE category = :category";
        
        //menyiapkan statement
        $stmt = $this->conn->prepare($query);
        
        //binding parameter keamanan
        $stmt->bindParam(':category', $category);
        
        //menjalankan eksekusi dan mengembalikan status (True jika berhasil, False jika gagal)
        return $stmt->execute();
    }
}
?>