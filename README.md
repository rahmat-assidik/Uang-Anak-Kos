# Sistem Informasi Manajemen Keuangan Personal: Uang Anak Kos

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white)

## 📋 Deskripsi Proyek

**Uang Anak Kos** merupakan sebuah platform berbasis web yang dirancang secara komprehensif untuk memfasilitasi pengelolaan manajemen keuangan personal, khususnya bagi kalangan mahasiswa maupun pekerja yang tinggal di hunian sewa (kos). Sistem ini bertujuan untuk meningkatkan literasi keuangan pengguna melalui pemantauan arus kas yang disiplin dan terstruktur.

Mengadopsi filosofi desain **Flat Administrative UI**, aplikasi ini menitikberatkan pada aspek fungsionalitas dan legibilitas data tanpa distraksi visual yang berlebihan. Penggunaan skema warna *gray-50* dan tipografi *Helvetica Neue* memberikan impresi profesional yang selaras dengan standar aplikasi manajemen finansial modern.

## 🚀 Fitur Utama

Sistem ini mencakup berbagai modul fungsional yang telah dioptimasi untuk kebutuhan pengguna:

*   **Dashboard Analitik**: Menyediakan representasi data saldo aktual, akumulasi pemasukan, dan pengeluaran dalam periode berjalan secara *real-time*.
*   **Visualisasi Arus Kas**: Integrasi dengan library *Chart.js* untuk menghasilkan grafik fluktuasi keuangan yang membantu dalam pengambilan keputusan finansial.
*   **Manajemen Transaksi Terpadu**: Modul entri data untuk mencatat setiap transaksi masuk dan keluar dengan presisi tinggi, lengkap dengan klasifikasi kategori.
*   **Sistem Kategori Dinamis**: Fleksibilitas bagi pengguna untuk mendefinisikan kategori transaksi sesuai dengan pola konsumsi personal.
*   **Keamanan Data**: Protokol autentikasi dan otorisasi yang ketat menggunakan *Laravel Breeze* untuk menjamin privasi data finansial pengguna.
*   **Arsitektur Responsif**: Antarmuka yang adaptif di berbagai resolusi layar, memastikan pengalaman pengguna yang konsisten baik di perangkat seluler maupun desktop.

## 🛠️ Spesifikasi Teknologi

Pengembangan sistem ini memanfaatkan *tech-stack* modern untuk menjamin performa dan skalabilitas:

| Komponen | Teknologi | Deskripsi |
| :--- | :--- | :--- |
| **Bahasa Pemrograman** | PHP 8.3+ | Keamanan dan performa tinggi pada sisi server. |
| **Framework Backend** | Laravel 13 | Arsitektur MVC yang robust dan aman. |
| **Framework CSS** | Tailwind CSS | Pengembangan antarmuka yang efisien dan modular. |
| **Logika Frontend** | Alpine.js | Reaktivitas ringan untuk komponen interaktif. |
| **Sistem Database** | MySQL | Penyimpanan data relasional yang stabil. |
| **Build Tool** | Vite | Optimalisasi aset frontend untuk *loading speed* maksimal. |

## ⚙️ Panduan Instalasi

Ikuti prosedur teknis di bawah ini untuk melakukan implementasi pada lingkungan lokal:

1.  **Replikasi Repositori**
    ```bash
    git clone https://github.com/rahmat-assidik/Uang-Anak-Kos.git
    cd Uang-Anak-Kos
    ```

2.  **Manajemen Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Instalasi Aset Frontend**
    ```bash
    npm install
    npm run build
    ```

4.  **Konfigurasi Lingkungan (.env)**
    Salin file templat konfigurasi dan generate kunci enkripsi aplikasi:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Pastikan untuk menyesuaikan parameter database pada file `.env`.*

5.  **Migrasi dan Seeding Database**
    ```bash
    php artisan migrate --seed
    ```

6.  **Eksekusi Server**
    ```bash
    php artisan serve
    ```

## 🎨 Standar Desain

Proyek ini mengimplementasikan sistem desain yang konsisten untuk menjaga integritas visual:
*   **Radius Komponen**: `4px` (Flat design standard).
*   **Tipografi**: `Helvetica Neue`, `Inter`, `Sans-serif`.
*   **Palet Warna**: Dominasi `Slate` dan `Gray` dengan aksen fungsional untuk status transaksi (Hijau untuk pemasukan, Merah untuk pengeluaran).

## 📄 Lisensi

Proyek ini didistribusikan di bawah Lisensi **MIT**. Untuk informasi lebih lanjut, silakan merujuk pada file `LICENSE`.

---
**Kontak Pengembang**: [Rahmat Assidik](https://github.com/rahmat-assidik)
