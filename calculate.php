<?php
/*
==================================================================================
Fungsi Utama File Ini (BACKEND LOGIC):

1. Menerima input hitungan matematika dari Frontend (AJAX).
2. Melakukan validasi keamanan agar hanya angka dan operator yang boleh masuk.
3. Menghitung hasil matematika menggunakan fungsi eval().
4. Menyimpan riwayat hitungan ke Database (Tabel History).
5. Mengembalikan hasil hitungan ke Frontend (Response Text).
==================================================================================
*/

//menghubungkan file ini dengan konfigurasi database
require_once "config/Database.php";

//membuat objek database dan membuka koneksi
$db = (new Database())->getConnection();

//mengambil data yang dikirim lewat metode POST dengan nama 'expression'
//tanda '??' artinya jika tidak ada data yang dikirim, isi dengan string kosong ''
$expression = $_POST['expression'] ?? '';

//cek Validasi 1: Jika input kosong, hentikan proses dan kembalikan angka 0
if ($expression == '') {
    echo "0";
    exit;
}

/*
  Cek Validasi 2 (Keamanan):
  Menggunakan Regex (Regular Expression) untuk memastikan input 
  HANYA berisi: Angka (0-9), Tambah (+), Kurang (-), Kali (*), Bagi (/),
  Kurung buka/tutup ( ), Titik (.), dan Spasi.
  
  Ini penting untuk mencegah user jahat menyusupkan kode PHP berbahaya ke eval().
*/
if (!preg_match('/^[0-9+\-*\/\(\). ]+$/', $expression)) {
    echo "Error"; // Jika ada huruf/simbol aneh, kirim pesan Error
    exit;
}

try {
    //! Proses Perhitungan
    $result = 0;
    
    //eval() adalah fungsi sakti PHP yang mengubah string matematika jadi kode program
    //contoh: string "2 + 2" dieksekusi jadi integer 4
    eval('$result = ' . $expression . ';');

    //! Proses Penyimpanan ke Database
    //siapkan query SQL untuk menyimpan soal (expression) dan jawabannya (result)
    //ditambah kategori 'biasa' untuk membedakan dengan kalkulator suhu
    $query = "INSERT INTO history (expression, result, category) VALUES (:expression, :result, 'biasa')";
    
    //prepare statement (langkah keamanan agar database aman dari SQL Injection)
    $stmt = $db->prepare($query);
    
    //mengikat (Binding) data ke parameter query
    $stmt->bindParam(':expression', $expression);
    $stmt->bindParam(':result', $result);
    
    //eksekusi penyimpanan ke database
    $stmt->execute();

    //! Mengembalikan Hasil
    //kirim hasil hitungan kembali ke JavaScript (script.js) untuk ditampilkan di layar
    echo $result;

} catch (Exception $e) {
    //jika terjadi error saat menghitung (misal dibagi 0), tangkap errornya
    echo "Error";
}
?>