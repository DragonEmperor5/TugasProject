<?php
/*
==================================================================================
Fungsi File Ini (History View Manual):

1. File ini berfungsi untuk menampilkan seluruh daftar riwayat perhitungan.
2. Menggunakan cara MANUAL (langsung query di file ini), tanpa lewat Controller.
3. Mengambil data dari database dan menampilkannya dalam bentuk tabel HTML.
==================================================================================
*/

require_once "config/Database.php"; //memanggil file konfigurasi untuk koneksi database

//membuat objek database baru dan membuka koneksi
$db = (new Database())->getConnection();

//menyiapkan query SQL:
//SELECT * : Ambil semua kolom
//FROM history : Dari tabel history
//ORDER BY id DESC : Urutkan dari ID terbesar (data terbaru muncul paling atas)
$query = "SELECT * FROM history ORDER BY id DESC";

//menyiapkan statement agar lebih aman (standar PDO)
$stmt = $db->prepare($query);

// Menjalankan query tersebut di database
$stmt->execute();

//mengambil SELURUH hasil data sekaligus dan menyimpannya ke variabel $data
//FETCH_ASSOC artinya data diambil dalam bentuk array asosiatif (key => value)
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Perhitungan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="history-container">
    <h2>Riwayat Perhitungan</h2>

    <table>
        <tr>
            <th>Ekspresi</th> <th>Hasil</th>    <th>Waktu</th>    </tr>

        <?php 
        //melakukan LOOPING (Perulangan) sebanyak data yang ditemukan.
        //setiap satu data akan disimpan sementara di variabel $row
        foreach ($data as $row): 
        ?>
        <tr>
            <td><?= htmlspecialchars($row['expression']) ?></td>
            
            <td><?= htmlspecialchars($row['result']) ?></td>
            
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endforeach; //akhir dari looping ?>
        
    </table>

    <a href="delete_history.php" class="delete-btn">Hapus Semua Riwayat</a>
    
    <a href="index.php" class="back-btn">Kembali</a>
</div>

</body>
</html>