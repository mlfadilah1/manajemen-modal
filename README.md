Manajemen Modal dengan BEP & ROI
📌 Deskripsi Proyek
Proyek ini merupakan sistem manajemen modal berbasis web yang membantu pengusaha dalam menganalisis keuangan bisnis menggunakan metode Break Even Point (BEP) dan Return on Investment (ROI). Dengan sistem ini, pengguna dapat memahami kapan bisnis mencapai titik impas serta mengevaluasi efisiensi investasi berdasarkan data keuangan yang diperoleh.

🎯 Tujuan Proyek
✅ Mempermudah analisis keuangan bisnis
✅ Menyediakan perhitungan BEP secara otomatis
✅ Menampilkan ROI untuk evaluasi investasi
✅ Menyajikan data keuangan dalam bentuk grafik interaktif
✅ Memungkinkan pengguna memilih periode analisis

🛠️ Teknologi yang Digunakan
Backend: Laravel
Frontend: Bootstrap, Chart.js
Database: MySQL

📊 Metode Analisis
Break Even Point (BEP):
Menentukan titik impas dalam unit dan rupiah
Membantu bisnis dalam menentukan harga jual dan volume produksi
Return on Investment (ROI):
Mengukur keuntungan yang diperoleh dibandingkan dengan modal yang diinvestasikan
Memberikan wawasan mengenai efisiensi investasi bisnis
Analisis Laba Bersih:
Menghitung keuntungan setelah dikurangi biaya operasional

📋 Fitur Utama
✔️ Perhitungan otomatis BEP unit dan BEP rupiah
✔️ Menampilkan laba bersih berdasarkan periode
✔️ Perhitungan ROI secara real-time
✔️ Visualisasi data dalam bentuk grafik batang yang dinamis
✔️ Manajemen User(Admin)
✔️ Biaya Operasional (Admin dan Staff)
✔️ Modal awal (Admin)
✔️ Produk (Admin)
✔️ Pendapatan (Admin dan staff)

📂 Instalasi & Konfigurasi
Clone repository:

git clone https://github.com/username/repository.git
cd repository
Install dependensi:


composer install
npm install
Konfigurasi .env & database:


cp .env.example .env
php artisan key:generate
Ubah pengaturan database pada file .env sesuai kebutuhan.

Migrasi database & seeding:


php artisan migrate --seed
Jalankan aplikasi:


php artisan serve

📈 Tampilan Aplikasi
Sistem menampilkan data dalam bentuk tabel dan grafik Chart.js, dengan opsi filter berdasarkan periode analisis.

📢 Kontributor
Muhammad Lutfi Fadilah