<?php
/*
==========================================
Bagian Konfigurasi Database
File ini berfungsi untuk membuka pintu koneksi ke MySQL.
==========================================
*/

class Database {
    //! Pengaturan Kredensial
    //private artinya variabel ini cuma bisa diakses di dalam class ini saja (Aman)
    
    private $host = "localhost";    //alamat server
    private $db_name = "kalkulator"; //nama database dibuat di phpMyAdmin
    private $username = "root";     //username
    private $password = "";         //password
    
    public $conn; //variabel untuk menyimpan objek koneksi yang berhasil dibuat

    //! Fungsi Koneksi
    //fungsi ini dipanggil oleh file lain (Controller) saat butuh data
    public function getConnection() {
        
        $this->conn = null; //reset koneksi dulu biar bersih
        
        try {
            //mencoba membuat koneksi baru menggunakan PDO (PHP Data Objects)
            //formatnya: "tipe_database:host=ALAMAT;dbname=NAMA_DB"
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            
            //mengatur Mode Error:
            //jika ada error (misal query salah), PDO akan melempar 'Exception'
            //ini penting biar kita tahu kalau ada yang error di kodingan SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            //CATCH: Bagian ini jalan KALAU koneksi GAGAL
            //Misal: XAMPP belum dinyalakan, atau nama database salah
            echo "Connection error: " . $exception->getMessage();
        }
        
        //mengembalikan objek koneksi agar bisa dipakai file lain
        return $this->conn;
    }
}
?>