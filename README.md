# 🏠 Uang Anak Kos

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)](https://mysql.com)

**Uang Anak Kos** adalah aplikasi manajemen keuangan sederhana namun powerful yang dirancang khusus untuk membantu anak kos (mahasiswa/pekerja) memantau arus kas harian mereka. Dengan desain **Flat UI** yang modern dan minimalis, aplikasi ini memberikan pengalaman pengguna yang bersih dan fokus pada data.

## ✨ Fitur Utama

-   📊 **Dashboard Ringkasan**: Lihat saldo total, pemasukan, dan pengeluaran bulan ini secara sekilas.
-   📈 **Grafik Interaktif**: Visualisasi arus kas menggunakan Chart.js untuk membantu analisis keuangan.
-   💸 **Manajemen Transaksi**: Catat pemasukan dan pengeluaran dengan detail sumber dan kategori.
-   🏷️ **Kategori Kustom**: Kelola kategori pengeluaran Anda sendiri untuk pengelompokan yang lebih baik.
-   🎨 **Flat Design**: Antarmuka modern dengan estetika flat yang nyaman dipandang.
-   📱 **Responsive**: Dapat diakses dengan nyaman melalui perangkat mobile maupun desktop.

## 🚀 Teknologi yang Digunakan

-   **Backend**: Laravel 11
-   **Frontend**: Tailwind CSS & Alpine.js
-   **Database**: MySQL
-   **Charts**: Chart.js
-   **Icons**: Heroicons

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lokal:

1. **Clone repositori**
   ```bash
   git clone https://github.com/username/Uang-Anak-Kos.git
   cd Uang-Anak-Kos
   ```

2. **Instal dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal dependensi Frontend**
   ```bash
   npm install && npm run dev
   ```

4. **Konfigurasi Environment**
   Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Migrasi Database**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

## 📸 Tampilan Dashboard

*Aplikasi ini menggunakan tema **Flat Modern** dengan kontras yang tinggi dan tipografi yang bersih untuk memastikan data keuangan Anda mudah dibaca.*

---

Dibuat dengan ❤️ untuk kemudahan finansial anak kos.
