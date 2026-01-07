<?php
require_once 'controllers/HistoryController.php';

//cek apakah ada request hapus
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    
    $history = new HistoryController();
    
    $history->clear();
    
    //setelah hapus, kembali ke index (redirect)
    $history->clear();
    
    // Redirect kembali ke halaman sebelumnya (agar dinamis)
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: index.php");
    }
    exit;
}
?>