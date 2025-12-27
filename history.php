<?php
require_once "config/Database.php";

$db = (new Database())->getConnection();
$query = "SELECT * FROM history ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute();
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
            <th>Ekspresi</th>
            <th>Hasil</th>
            <th>Waktu</th>
        </tr>

        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['expression']) ?></td>
            <td><?= htmlspecialchars($row['result']) ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="delete_history.php" class="delete-btn">Hapus Semua Riwayat</a>
    <a href="index.php" class="back-btn">Kembali</a>
</div>

</body>
</html>
