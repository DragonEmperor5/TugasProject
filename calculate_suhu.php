<?php
/*
==================================================================================
Fungsi Utama File Ini (Backend Suhu):

1. Menerima input suhu, satuan awal (From), dan satuan tujuan (To).
2. Menggunakan logika "Jembatan Celcius": Semua input dikonversi ke Celcius dulu,
baru kemudian dikonversi ke satuan tujuan. Ini agar rumusnya lebih ringkas.
3. Membulatkan hasil agar komanya tidak kepanjangan.
4. Menyimpan riwayat konversi ke Database dengan kategori 'suhu'.
5. Mengembalikan respon dalam format JSON (bukan teks biasa).
==================================================================================
*/

require_once "config/Database.php";

//buka koneksi database
$db = (new Database())->getConnection();

//ambil data input dari form HTML
// ?? '' artinya kalau tidak ada data, anggap kosong/default
$val = $_POST['value'] ?? ''; 
$from = $_POST['from'] ?? 'C'; //satuan asal (default Celcius)
$to = $_POST['to'] ?? 'F';     //satuan tujuan (default Fahrenheit)

//validasi: Jika nilai kosong, kirim status error dalam format JSON
if ($val === '') {
    echo json_encode(['status' => 'error']);
    exit;
}

//pastikan input angka dibaca sebagai Float (bilangan desimal), bukan teks
$suhu = floatval($val);
$hasil = 0;

//! Langkah 1: Konversi Ke "Base" (CELCIUS)
//apapun satuan asalnya (F/K/R), kita ubah dulu ke Celcius.
//ini trik programming biar kita gak perlu nulis 12 rumus berbeda.
$celsius = 0;
switch ($from) {
    case 'C': $celsius = $suhu; break; //sudah Celcius, biarkan
    case 'F': $celsius = ($suhu - 32) * 5/9; break; //rumus F ke C
    case 'K': $celsius = $suhu - 273.15; break;     //rumus K ke C
    case 'R': $celsius = $suhu * 5/4; break;        //rumus R ke C
}

//! Langkah 2: Dari Celcius Ke Target
//sekarang kita sudah punya nilai Celcius, tinggal ubah ke target.
switch ($to) {
    case 'C': $hasil = $celsius; break;
    case 'F': $hasil = ($celsius * 9/5) + 32; break; //rumus C ke F
    case 'K': $hasil = $celsius + 273.15; break;     //rumus C ke K
    case 'R': $hasil = $celsius * 4/5; break;        //rumus C ke R
}

//format hasil: Bulatkan jadi max 2 angka di belakang koma (misal: 100.45)
$hasil = round($hasil, 2);

//! Simpan Ke Database
//kita buat format teks yang enak dibaca untuk riwayat.
//contoh: "100 °C ke °F"
$expression = "$suhu °$from ke °$to";

try {    
    //query Insert. Perhatikan 'category' diisi 'suhu' agar beda dengan kalkulator biasa
    $query = "INSERT INTO history (expression, result, category) VALUES (:expression, :result, 'suhu')";
    
    $stmt = $db->prepare($query);
    
    //binding parameter untuk mencegah SQL Injection
    $stmt->bindParam(':expression', $expression);
    $stmt->bindParam(':result', $hasil);
    $stmt->execute();
    
    //! Output JSON
    //mengembalikan data Sukses + Hasilnya ke JavaScript
    echo json_encode([
        'status' => 'success',
        'result' => $hasil
    ]);
} catch (Exception $e) {
    //jika database error
    echo json_encode(['status' => 'error']);
}
?>