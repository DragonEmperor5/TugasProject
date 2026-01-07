<?php
require_once 'controllers/HistoryController.php';

$category = $_GET['cat'] ?? 'biasa'; // Ambil info kategori dari URL

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $history = new HistoryController();
    $history->clearByCategory($category); // Hapus spesifik kategori
    
    // Kembali ke halaman asal berdasarkan kategori
    $location = ($category == 'suhu') ? "kalkulator_suhu.php" : "kalkulator_biasa.php";
    header("Location: " . $location);
    exit;
}
?>