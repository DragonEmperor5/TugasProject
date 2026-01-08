<?php
/*
==================================================================================
Fungsi Utama File Ini (Delete Action):

1. Menerima request hapus dengan parameter kategori ('biasa' atau 'suhu').
2. Memanggil Controller untuk menghapus data HANYA sesuai kategori tersebut.
3. Melakukan Redirect (pengalihan halaman) kembali ke kalkulator yang sesuai.
(Jika hapus suhu -> balik ke suhu. Jika hapus biasa -> balik ke biasa).
==================================================================================
*/

require_once 'controllers/HistoryController.php';

//ambil parameter 'cat' dari URL (contoh: delete_history.php?action=clear&cat=suhu)
//tanda '??' artinya jika tidak ada parameter 'cat', default-nya anggap 'biasa'
$category = $_GET['cat'] ?? 'biasa'; 

//cek apakah ada perintah 'action=clear' di URL
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    
    //panggil Controller
    $history = new HistoryController();
    
    //penting: panggil fungsi baru 'clearByCategory' (bukan clear all)
    //agar saat hapus history suhu, history matematika tidak ikut hilang.
    $history->clearByCategory($category); 
    
// Logika Redirect: Cek kategori untuk menentukan user harus balik ke mana
    if ($category == 'suhu') {
        // Jika yang dihapus history suhu, balik ke Kalkulator Suhu
        $location = "kalkulator_suhu.php";
    } else {
        // Jika yang dihapus history biasa, balik ke Kalkulator Biasa
        // (JANGAN ke index.php, karena index.php itu Dashboard)
        $location = "kalkulator_biasa.php"; 
    }
    
    //lakukan pengalihan halaman
    header("Location: " . $location);
    exit; //stop script agar tidak ada kode lain yang jalan
} else {
    //jika file ini dibuka tanpa action clear, kembalikan ke index
    header("Location: index.php");
    exit;
}
?>