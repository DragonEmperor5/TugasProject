//! Bagian 1: inisialisasi variabel

//mengambil elemen HTML berdasarkan ID-nya agar bisa diatur isinya lewat JS
let display = document.getElementById('inputDisplay');   //layar utama (tempat ngetik angka)
let subDisplay = document.getElementById('resultDisplay'); //layar kecil (tempat hasil preview)

//! Bagian 2: fungsi input

//fungsi ini dipanggil saat tombol angka (0-9) ditekan
function appendNumber(number) {
    //menambahkan angka yang diklik ke layar (misal: "1" ditambah "2" jadi "12")
    display.value += number;
}

//fungsi ini dipanggil saat tombol operator (+, -, *, /) ditekan
function appendOperator(operator) {
    //ambil 1 karakter paling belakang yang ada di layar saat ini
    const lastChar = display.value.slice(-1);

    //Logika pencegahan error:
    //cek apakah karakter terakhir itu juga operator?
    //array ini berisi daftar operator yang dicek
    if (['+', '-', '*', '/'].includes(lastChar)) {
        //jika iya (misal user ngetik "5+" lalu ngetik "-"), 
        //maka hapus "+" yang lama dulu biar gak jadi "5+-"
        display.value = display.value.slice(0, -1);
    }
    
    //baru tambahkan operator yang baru
    display.value += operator;
}

//fungsi untuk tombol 'C' (Clear)
function clearDisplay() {
    display.value = '';        //kosongkan layar input
    subDisplay.innerText = ''; //kosongkan layar hasil
}

//fungsi untuk tombol Backspace (Hapus satu karakter)
function deleteLast() {
    //memotong string dari awal sampai 1 karakter sebelum akhir
    display.value = display.value.slice(0, -1);
}

//! Bagian 3: fungsi utama (menghubungkan ke backend)

function calculate() {
    //1. Ambil apa yang tertulis di layar input saat ini
    let expression = display.value;

    //2. Cek validasi sederhana: Kalau kosong, jangan kirim apa-apa
    if(expression === '') return;

    //3. Siapkan data untuk dikirim (membungkus data layaknya formulir)
    let formData = new FormData();
    formData.append('expression', expression); //'expression' adalah nama kunci yang akan dibaca $_POST di PHP

    //4. Proses AJAX (Fetch API)
    //mengirim data ke 'calculate.php' tanpa mereload halaman browser
    fetch('calculate.php', {
        method: 'POST',     //metode pengiriman data
        body: formData      //data yang dikirim
    })
    .then(response => response.text()) //5. Backend mengembalikan TEXT biasa (bukan JSON)
    .then(result => {
        //6. Menerima balasan dari server
        //cek validasi error dari backend (misal user kirim "5++")
        //trim() gunanya menghapus spasi kosong di awal/akhir text
        if (result.trim() === "Error" || (result.trim() === "0" && expression !== "0")) {
            alert('Format hitungan salah!'); //munculkan popup peringatan
        } else {
            //Jika sukses:
            
            //tampilkan tulisan "5 + 5 =" di layar kecil
            subDisplay.innerText = expression + ' =';
            
            //tampilkan hasil "10" di layar input utama
            display.value = result;
            
            //panggil fungsi untuk update daftar riwayat di kanan secara realtime
            addToHistoryList(expression, result);
        }
    })
    .catch(error => {
        //jika koneksi internet putus atau server mati
        console.error('Error:', error);
    });
}

//! Bagian 4: manipulasi dom (tampilan riwayat)

//fungsi untuk menambah baris baru di kolom Riwayat sebelah kanan
function addToHistoryList(exp, res) {
    //ambil elemen <ul> tempat list riwayat berada
    const list = document.getElementById('historyList');
    
    //bikin elemen <li> baru (belum ditempel ke layar)
    const newItem = document.createElement('li');
    
    //isi HTML di dalam <li> tersebut (Soal di kiri, Jawaban tebal di kanan)
    newItem.innerHTML = `<span>${exp}</span> <strong>= ${res}</strong>`;
    
    //Logika urutan:
    //cek apakah list sudah punya isi?
    if(list.firstChild) {
        //jika ada, selipkan item baru sebelum item pertama (biar paling atas)
        list.insertBefore(newItem, list.firstChild);
    } else {
        //jika list masih kosong, langsung masukkan saja
        list.appendChild(newItem);
    }
}