<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Portfolio & Blog Pribadi dengan Laravel

Aplikasi ini adalah website portfolio pribadi yang terintegrasi dengan sistem blog, dibangun menggunakan framework Laravel. Proyek ini dirancang untuk menampilkan karya-karya (portfolio), memungkinkan pemilik untuk menulis dan mengelola artikel blog, serta menyediakan antarmuka admin yang aman untuk manajemen konten.

## Fitur Utama

### Tampilan Publik:

* **Home**: Profil singkat, daftar postingan blog terbaru, dan karya portfolio pilihan.
* **Work**: Galeri proyek portfolio dengan gambar, tahun, kategori, dan deskripsi.
* **Blog**: Daftar artikel blog dengan paginasi, filter berdasarkan kategori, dan halaman detail.
* **Kontak**: Informasi kontak pemilik.
* **404 Kustom**: Penanganan URL yang tidak ditemukan.

### Area Admin:

* Login admin khusus.
* Dashboard sederhana.
* CRUD untuk Kategori Blog.
* CRUD untuk Postingan Blog (dengan upload gambar dan editor WYSIWYG/TinyMCE).
* CRUD untuk Proyek Portfolio (dengan upload gambar).

### Fitur Teknis:

* Slug otomatis untuk postingan dan kategori.
* Pagination di publik dan admin.
* Styling dengan Tailwind CSS.
* (Opsional) Login Google & TinyMCE API Key (dinonaktifkan di UI).

## Prasyarat Sistem

* PHP >= 8.1
* Composer
* Node.js & NPM/Yarn
* Database: MySQL (direkomendasikan), PostgreSQL, SQLite
* Web server: Apache/Nginx (XAMPP, Laragon, Valet, Sail)
* Ekstensi PHP: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
* Git

## Instalasi Lokal

1. **Clone repositori**

```bash
git clone https://github.com/danyakmallun9999/portfolio-blog.git
cd NAMA_REPOSITORI
```

2. **Install dependensi PHP**

```bash
composer install
```

3. **Salin file environment & konfigurasi**

```bash
cp .env.example .env
```

Edit file `.env` untuk koneksi database dan `APP_URL`.

4. **Generate APP\_KEY**

```bash
php artisan key:generate
```

5. **Migrasi database**

```bash
php artisan migrate
```

6. **Symbolic link untuk storage**

```bash
php artisan storage:link
```

7. **Install dependensi frontend**

```bash
npm install
# atau
yarn install
```

8. **Kompilasi aset frontend**

```bash
npm run dev
```

9. **Seed database (data awal)**

```bash
php artisan db:seed
```

Admin Default:

* Email: `admin@example.com`
* Password: `password`

10. **Jalankan server lokal**

```bash
php artisan serve
```

Akses di `http://localhost:8000`

## Struktur Direktori Penting

* `app/Http/Controllers/`
* `app/Models/`
* `config/`
* `resources/views/`
* `resources/js/`
* `resources/css/`
* `routes/`
* `database/migrations/`
* `database/seeders/`
* `public/`
* `.env`
* `composer.json`
* `package.json`
* `tailwind.config.js`
* `vite.config.js`

## Fitur Dinonaktifkan

* Registrasi publik
* Login Google (aktifkan kembali di `.env`, `routes/web.php`, dan UI)

## Menjalankan Tes

```bash
php artisan test
# atau
./vendor/bin/phpunit
```

Gunakan database testing terpisah (SQLite in-memory).

## Lisensi

Proyek ini dibuat untuk portfolio pribadi. Tambahkan lisensi jika diperlukan (misal: MIT License).
