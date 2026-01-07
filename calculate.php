<?php
require_once "config/Database.php";

$db = (new Database())->getConnection();

$expression = $_POST['expression'] ?? '';

if ($expression == '') {
    echo "0";
    exit;
}
/*
  Keamanan:
  - hanya angka dan operator matematika
*/
if (!preg_match('/^[0-9+\-*\/\(\). ]+$/', $expression)) {
    echo "Error";
    exit;
}

try {
    // Hitung ekspresi matematika
    $result = 0;
    eval('$result = ' . $expression . ';');

    // Simpan ke database (PDO)
    $query = "INSERT INTO history (expression, result, category) VALUES (:expression, :result, 'biasa')";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':expression', $expression);
    $stmt->bindParam(':result', $result);
    $stmt->execute();

    echo $result;
} catch (Exception $e) {
    echo "Error";
}
