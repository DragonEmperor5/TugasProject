#  Kalkulator Online (PHP & MySQL)

Kalkulator Online adalah aplikasi web sederhana berbasis **PHP**, **MySQL**, dan **JavaScript** yang menyediakan berbagai fitur perhitungan serta penyimpanan riwayat hasil kalkulasi ke dalam database.

Project ini cocok untuk:
- Tugas kuliah
- Latihan CRUD PHP & MySQL
- Contoh penerapan MVC sederhana

---

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
📂 project-kalkulator/
├── 📂 assets/
│   ├── 📂 css/
│   │   └── 📄 style.css
│   └── 📂 js/
│       └── 📄 script.js
├── 📂 config/
│   └── 📄 Database.php
├── 📂 controllers/
│   └── 📄 HistoryController.php
├── 📂 database/
│   └── 📄 kalkulator.sql
├── 📄 calculate.php
├── 📄 calculate_suhu.php
├── 📄 delete_history.php
├── 📄 history.php
├── 📄 index.php
├── 📄 kalkulator_biasa.php
├── 📄 kalkulator_suhu.php
└── 📄 README.md

---

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
