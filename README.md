<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Portfolio & Blog Pribadi dengan Laravel
=======================================

Aplikasi ini adalah sebuah website portfolio pribadi yang terintegrasi dengan sistem blog, dibangun menggunakan framework Laravel. Proyek ini dirancang untuk menampilkan karya-karya (portfolio), memungkinkan pemilik untuk menulis dan mengelola artikel blog, serta menyediakan antarmuka admin yang aman dengan sistem otorisasi berbasis peran untuk manajemen konten.

Tech Stack
-------------------------------

*   **Framework Backend:** Laravel 11+
    
*   **Bahasa Pemrograman:** PHP 8.1+
    
*   **Frontend:** Tailwind CSS, Alpine.js
    
*   **Database:** MySQL / PostgreSQL
    
*   **Paket Utama:**
    
    *   laravel/breeze: Untuk scaffolding autentikasi dasar.
        
    *   spatie/laravel-permission: Untuk implementasi Role-Based Access Control (RBAC).
        
    *   anhskohbo/no-captcha (Rencana): Untuk implementasi Google reCAPTCHA.
        
*   **Alat Pengembangan:** Vite, Composer, NPM/Yarn, Git.
    

Fitur Unggulan
--------------

### Fitur Publik

*   **Halaman Responsif:** Semua halaman (Home, Blog, Detail Post, Work, Detail Work, Kontak) dirancang agar terlihat bagus di semua perangkat.
    
*   **Filter & Pagination Blog:** Pengunjung dapat memfilter postingan berdasarkan kategori dan menavigasi halaman dengan mudah.
    
*   **Halaman Error Kustom:** Tampilan profesional untuk halaman 403, 404, 419, dan 500.
    

### Fitur Admin Panel

*   **Otorisasi** Berbasis **Peran (RBAC):**
    
    *   Sistem peran (Super Admin, Penulis Blog, Manajer Portfolio) dan hak akses yang jelas.
        
    *   Tampilan menu dan dasbor yang dinamis sesuai dengan hak akses pengguna.
        
*   **Manajemen Konten Penuh (CRUD):**
    
    *   Manajemen **Pengguna** (termasuk penetapan peran).
        
    *   Manajemen **Kategori Blog**.
        
    *   Manajemen **Postingan Blog** dengan editor WYSIWYG (TinyMCE) dan upload gambar.
        
    *   Manajemen **Proyek Portfolio**.
        
*   **Pengalaman Pengguna (UX) yang Ditingkatkan:**
    
    *   Menggunakan **Modal Konfirmasi Profesional** untuk tindakan destruktif (seperti hapus data), menggantikan alert browser bawaan.
        
    *   Antarmuka yang konsisten dan responsif di seluruh panel admin.
        

Instalasi & Konfigurasi Lokal
-----------------------------

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1\. Prasyarat

Pastikan semua perangkat lunak di bagian **Tumpukan Teknologi** sudah terinstal di sistem Anda.

### 2\. Clone Repositori

```bash
git clone [https://github.com/danyakmallun9999/portfolio-blog.git](https://github.com/danyakmallun9999/portfolio-blog.git)  
cd portfolio-blog
```

### 3\. Install Dependensi

```bash
# Install dependensi PHP  composer install  
# Install dependensi Node.js  npm install
```

### 4\. Konfigurasi Environment

```bash
# Salin file environment contoh  cp .env.example .env  
# Generate kunci aplikasi unik  php artisan key:generate
```

Setelah itu, buka file .env dan konfigurasikan koneksi database Anda (DB\_DATABASE, DB\_USERNAME, DB\_PASSWORD) serta APP\_URL.

### 5\. Setup Database & Data Awal

Jalankan perintah berikut untuk membuat semua tabel database dan mengisinya dengan data awal (termasuk peran, hak akses, dan akun admin default):

```bash
php artisan migrate:fresh --seed
```

*   **Akun Admin Default:**
    
    *   **Email:** admin@example.com
        
    *   **Password:** password_(Segera_ ganti password ini setelah login pertama _kali!)_
        

### 6\. Buat Symbolic Link untuk Storage

Agar file yang di-upload (seperti gambar postingan) dapat diakses, jalankan:

```bash
php artisan storage:link
```

### 7\. Jalankan Server

Anda perlu menjalankan dua server secara bersamaan di dua terminal terpisah.

*   npm run dev
    
*   php artisan serve
    

Aplikasi sekarang dapat diakses di http://localhost:8000 (atau URL yang ditampilkan oleh php artisan serve).

Sistem Otorisasi (Roles & Permissions)
--------------------------------------

Proyek ini menggunakan paket spatie/laravel-permission untuk mengelola hak akses. Berikut adalah peran default yang dibuat oleh seeder:

*   **Super Admin:** Memiliki akses penuh ke semua fitur di panel admin.
    
*   **Penulis Blog (Blog Writer):** Hanya dapat mengakses dan mengelola postingan blog (manage posts).
    
*   **Manajer Portfolio (Work Manager):** Hanya dapat mengakses dan mengelola proyek portfolio (manage works).
    

Anda dapat mengelola pengguna dan menetapkan peran mereka melalui menu "Users" setelah login sebagai Super Admin.

Menjalankan Tes
---------------

Untuk menjalankan rangkaian tes otomatis PHPUnit:

```bash
php artisan test
```

Pastikan Anda sudah membuat dan mengkonfigurasi file .env.testing untuk menggunakan database terpisah (direkomendasikan SQLite in-memory).

Lisensi
-------

Proyek ini dikembangkan untuk keperluan portfolio pribadi.
