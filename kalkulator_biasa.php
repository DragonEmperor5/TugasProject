<?php
include_once 'controllers/HistoryController.php';
$historyController = new HistoryController();
$stmt = $historyController->readByCategory('biasa');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Online Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="calculator">
        <div class="display">
            <div id="resultDisplay" class="sub-display"></div>
            <input type="text" id="inputDisplay" placeholder="0" readonly>
        </div>
        
        <div class="buttons">
            <button class="btn-clear" onclick="clearDisplay()">C</button>
            <button class="btn-op" onclick="appendOperator('/')">÷</button>
            <button class="btn-op" onclick="appendOperator('*')">×</button>
            <button class="btn-del" onclick="deleteLast()">⌫</button>

            <button onclick="appendNumber('7')">7</button>
            <button onclick="appendNumber('8')">8</button>
            <button onclick="appendNumber('9')">9</button>
            <button class="btn-op" onclick="appendOperator('-')">-</button>

            <button onclick="appendNumber('4')">4</button>
            <button onclick="appendNumber('5')">5</button>
            <button onclick="appendNumber('6')">6</button>
            <button class="btn-op" onclick="appendOperator('+')">+</button>

            <button onclick="appendNumber('1')">1</button>
            <button onclick="appendNumber('2')">2</button>
            <button onclick="appendNumber('3')">3</button>
            <button class="btn-equal" onclick="calculate()">=</button>
            
            <button class="btn-zero" onclick="appendNumber('0')">0</button>
            <button onclick="appendNumber('.')">.</button>
        </div>
        <a href="index.php" class="back-link" style="display:block; text-align:center; margin-top:15px; font-size: 0.7rem; color: #000; text-decoration: none;">
            &lt; Kembali ke Menu
        </a>
    </div>

    <div class="history-panel">
        <h3>Riwayat Perhitungan</h3>
        <div class="history-list-wrapper">
            <ul id="historyList">
                <?php 
                //loop data awal saat halaman dimuat
                if ($stmt) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<li><span>" . $row['expression'] . "</span> <strong>= " . $row['result'] . "</strong></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <a href="delete_history.php?action=clear" class="btn-reset" onclick="return confirm('Hapus semua riwayat?')">Hapus Riwayat</a>
    </div>
</div>

<script src="assets/js/script.js"></script>

</body>
</html>