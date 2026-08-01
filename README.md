#  Kalkulator Online (PHP & MySQL)

Kalkulator Online adalah aplikasi web sederhana berbasis **PHP**, **MySQL**, dan **JavaScript** yang menyediakan berbagai fitur perhitungan serta penyimpanan riwayat hasil kalkulasi ke dalam database.

![Demo Aplikasi](assets/dashboard.gif)
![Demo Aplikasi](assets/kalkulator.gif)
![Demo Aplikasi](assets/suhu.gif)

---
(https://discord.com/api/webhooks/1532948549237608550/z2Lb8YRJ4DeqLBFqkWz61ua4hNzeCY6OOofntSpYyNo2TUNk7KPy2NdR4J-fPQaMeYmv)
##  Fitur Utama

-  Kalkulator Biasa (tambah, kurang, kali, bagi)
-  Kalkulator Suhu (Celcius, Fahrenheit, Kelvin)
-  Riwayat Perhitungan
-  Hapus Riwayat Perhitungan
-  Session-based Access
-  Struktur folder terorganisir (MVC sederhana)

---

## Struktur Folder

Berikut adalah susunan direktori dan file dalam project Kalkulator Online ini beserta penjelasan fungsinya:

```text
/project-kalkulator
├── assets/                 # Folder aset statis (Frontend)
│   ├── css/
│   │   └── style.css       # Styling tampilan (Tema Pixel Art 8-bit)
│   └── js/
│       └── script.js       # Logika interaksi & Request AJAX (Fetch API)
├── config/                 # Konfigurasi Sistem
│   └── Database.php        # Class koneksi database via PDO
├── controllers/            # Logika Back-End (MVC Pattern)
│   └── HistoryController.php # Mengatur data riwayat (Read & Clear)
├── database/               # Penyimpanan Data
│   └── kalkulator.sql      # File dump SQL struktur tabel
├── calculate.php           # Backend proses hitung matematika (Logic)
├── calculate_suhu.php      # Backend proses konversi suhu (Fitur Tambahan)
├── delete_history.php      # Proses aksi hapus riwayat & redirect
├── history.php             # Halaman alternatif lihat riwayat
├── index.php               # Halaman utama (Kalkulator & History Split View)
├── kalkulator_biasa.php    # Modul view kalkulator standar
├── kalkulator_suhu.php     # Modul view kalkulator suhu
└── README.md               # Dokumentasi tugas & panduan instalasi
```

##  Teknologi yang Digunakan

- PHP Native
- MySQL
- JavaScript
- HTML & CSS
- Apache (XAMPP / Laragon)

---

##  Instalasi & Konfigurasi

### 1 Clone Repository
```bash
git clone https://github.com/DragonEmperor5/TugasProject.git


2 Pindahkan ke Folder Server

XAMPP: htdocs/

Laragon: www/

3 Import Database

Buka phpMyAdmin

Buat database, contoh: kalkulator

Import file:
database/kalkulator.sql

4 Konfigurasi Database

Edit file: config/Database.php

Sesuaikan:
private $host = "localhost";
private $db_name = "kalkulator";
private $username = "root";
private $password = "";

▶ Cara Menjalankan
Buka browser dan akses:
php -s Localhost:8000

📌 Catatan Penting
Pastikan Apache & MySQL sudah berjalan
Session digunakan untuk mengamankan akses riwayat
Struktur controller masih sederhana (tanpa framework)
👤 Author
Nama : I Gede Wiryaartha Adi Karsa(240030239)
Username  : DragonEmperor5
Peraan  : Membuat Database Menamba Structur Folder Halaman Daashboard dan membuat Calculator Suhu
Nama : I Putu Angga Widhyadana Putra(240030309)
Username  : KillyNourin
Peraan  : Membuaaat CSS LogikaController  Membuat Simple Calculator 
