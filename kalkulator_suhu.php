<?php
include_once 'controllers/HistoryController.php';
$historyController = new HistoryController();
// Kita gunakan controller yang sama untuk mengambil history (opsional)
$stmt = $historyController->readByCategory('suhu');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Suhu</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="calculator" style="width: 400px;"> <h3>KONVERSI SUHU</h3>
        <hr style="border: 2px solid black; margin-bottom: 20px;">
        
        <div class="form-group">
            <label>Nilai Suhu:</label>
            <input type="number" id="inputTemp" class="pixel-input" placeholder="0">
        </div>

        <div class="form-group">
            <label>Dari:</label>
            <select id="fromUnit" class="pixel-input">
                <option value="C">Celcius (°C)</option>
                <option value="F">Fahrenheit (°F)</option>
                <option value="K">Kelvin (K)</option>
                <option value="R">Reamur (°R)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ke:</label>
            <select id="toUnit" class="pixel-input">
                <option value="F">Fahrenheit (°F)</option>
                <option value="C">Celcius (°C)</option>
                <option value="K">Kelvin (K)</option>
                <option value="R">Reamur (°R)</option>
            </select>
        </div>

        <button class="btn-op" style="width: 100%; margin-top: 10px;" onclick="hitungSuhu()">HITUNG</button>
        <a href="index.php" class="back-link" style="display:block; text-align:center; margin-top:15px; font-size: 0.7rem; color: #000;">&lt; Kembali ke Menu</a>
    </div>

    <div class="history-panel">
        <div class="display" style="height: 80px; margin-bottom: 10px;">
            <div class="sub-display">HASIL:</div>
            <div id="resultTemp" style="font-size: 1.2rem; text-align: right; margin-top: 10px;">---</div>
        </div>

        <h3>Riwayat Terakhir</h3>
        <div class="history-list-wrapper">
            <ul id="historyList">
                <?php 
                if ($stmt) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        // Filter agar hanya menampilkan yang terlihat seperti suhu (opsional)
                        // atau tampilkan semua history gabungan
                        echo "<li><span>" . $row['expression'] . "</span> <strong>= " . $row['result'] . "</strong></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <a href="delete_history.php?action=clear&cat=suhu" class="btn-reset" onclick="return confirm('Yakin ingin menghapus semua riwayat?')">Hapus Riwayat</a>
    </div>
</div>

<script>
function hitungSuhu() {
    const val = document.getElementById('inputTemp').value;
    const from = document.getElementById('fromUnit').value;
    const to = document.getElementById('toUnit').value;

    if(val === '') {
        alert("Masukkan angka suhu!");
        return;
    }

    let formData = new FormData();
    formData.append('value', val);
    formData.append('from', from);
    formData.append('to', to);

    fetch('calculate_suhu.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Kita harap balasannya JSON
    .then(data => {
        if(data.status === 'success') {
            // Update tampilan hasil
            document.getElementById('resultTemp').innerText = data.result + " °" + to;
            
            // Tambah ke list history (HTML manipulation)
            const list = document.getElementById('historyList');
            const newItem = document.createElement('li');
            newItem.innerHTML = `<span>${val}°${from} ke °${to}</span> <strong>= ${data.result}</strong>`;
            if(list.firstChild) {
                list.insertBefore(newItem, list.firstChild);
            } else {
                list.appendChild(newItem);
            }
        } else {
            alert('Terjadi kesalahan');
        }
    });
}
</script>

</body>
</html>