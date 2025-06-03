<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkController as PublicWorkController; // Alias untuk controller publik
use App\Http\Controllers\PostController as PublicPostController; // Alias untuk controller publik
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/work', [PublicWorkController::class, 'index'])->name('work.index');
// Route::get('/work/{work}', [PublicWorkController::class, 'show'])->name('work.show'); // Jika ada detail work
Route::get('/blog', [PublicPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PublicPostController::class, 'show'])->name('blog.show'); // Menggunakan route model binding dengan slug
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Jika ada form kontak

// Route bawaan Breeze untuk dashboard (yang digunakan sebagai basis admin)
Route::get('/dashboard', function () {
    // Arahkan ke dashboard admin jika sudah ada
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Grup Route untuk Admin (yang memerlukan login)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Kategori Blog
    Route::resource('categories', AdminCategoryController::class)->except(['show']); // Tidak perlu halaman show untuk kategori

    // CRUD Blog Posts
    Route::resource('posts', AdminPostController::class);

    // CRUD Works (Projek)
    Route::resource('works', AdminWorkController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';