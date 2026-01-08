
<!-- ======================================================================
Fungsi File Ini (Dashboard Utama):
1. Ini halaman menu utama saat aplikasi dibuka.
2. User memilih mau pakai 'Kalkulator Biasa' atau 'Suhu'.
3. File ini menghubungkan desain (CSS) dan font.
====================================================================== -->

<!DOCTYPE html>
<html lang="id"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- JUDUL DI TAB BROWSER -->
    <title>Dashboard Kalkulator</title>
    
    <!-- MEMANGGIL FONT STYLE PIXEL DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <!-- MENGHUBUNGKAN DENGAN FILE CSS (WARNA & DESAIN) -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="dashboard-container">
    <!-- JUDUL BESAR DI TENGAH LAYAR -->
    <h1 class="dashboard-title">PILIH ALAT HITUNG</h1>
    
    <div class="menu-grid">
        
        <!-- PILIHAN MENU 1: KALKULATOR BIASA -->
        <!-- Saat diklik, pindah ke file 'kalkulator_biasa.php' -->
        <a href="kalkulator_biasa.php" class="menu-card">
            <div class="icon">🧮</div>
            <h3>Kalkulator Biasa</h3>
            <p>Tambah, Kurang, Kali, Bagi</p>
        </a>

        <!-- PILIHAN MENU 2: KONVERSI SUHU  -->
        <!-- Saat diklik, pindah ke file 'kalkulator_suhu.php' -->
        <a href="kalkulator_suhu.php" class="menu-card">
            <div class="icon">🌡️</div>
            <h3>Konversi Suhu</h3>
            <p>Celcius, Fahrenheit, Kelvin</p>
        </a>
        
    </div>
</div>

</body>
</html>