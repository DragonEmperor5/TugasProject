<?php
require_once "config/Database.php";

$db = (new Database())->getConnection();

$val = $_POST['value'] ?? '';
$from = $_POST['from'] ?? 'C';
$to = $_POST['to'] ?? 'F';

if ($val === '') {
    echo json_encode(['status' => 'error']);
    exit;
}

$suhu = floatval($val);
$hasil = 0;

// Logika Konversi ke Celcius dulu (sebagai base)
$celsius = 0;
switch ($from) {
    case 'C': $celsius = $suhu; break;
    case 'F': $celsius = ($suhu - 32) * 5/9; break;
    case 'K': $celsius = $suhu - 273.15; break;
    case 'R': $celsius = $suhu * 5/4; break;
}

// Dari Celcius konversi ke Target
switch ($to) {
    case 'C': $hasil = $celsius; break;
    case 'F': $hasil = ($celsius * 9/5) + 32; break;
    case 'K': $hasil = $celsius + 273.15; break;
    case 'R': $hasil = $celsius * 4/5; break;
}

// Format hasil biar tidak kepanjangan komanya
$hasil = round($hasil, 2);

// Simpan ke Database (Agar masuk history)
// Expression kita format teks misal: "100 C ke F"
$expression = "$suhu °$from ke °$to";

try {
    $query = "INSERT INTO history (expression, result) VALUES (:expression, :result)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':expression', $expression);
    $stmt->bindParam(':result', $hasil);
    $stmt->execute();
    
    // Kembalikan JSON ke JavaScript
    echo json_encode([
        'status' => 'success',
        'result' => $hasil
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error']);
}
?>