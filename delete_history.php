<?php
require_once 'controllers/HistoryController.php';

//cek apakah ada request hapus
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    
    $history = new HistoryController();
    
    $history->clear();
    
    //setelah hapus, kembali ke index (redirect)
    header("Location: index.php");
    exit;
} else {
    //jika diakses tanpa action, kembalikan juga
    header("Location: index.php");
    exit;
}
?>