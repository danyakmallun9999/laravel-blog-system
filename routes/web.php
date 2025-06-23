<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkController as PublicWorkController;
use App\Http\Controllers\PostController as PublicPostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/work', [PublicWorkController::class, 'index'])->name('work.index');
Route::get('/work/{work}', [PublicWorkController::class, 'show'])->name('work.show');
Route::get('/blog', [PublicPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PublicPostController::class, 'show'])->name('blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Grup Route untuk Admin (yang memerlukan login)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // ==================== PENAMBAHAN OTORISASI MIDDLEWARE ====================
    // Setiap akses ke rute, resource ini akan dicek permission-nya.

    // CRUD Kategori Blog - hanya bisa diakses oleh user dengan permission 'manage categories'
    Route::resource('categories', AdminCategoryController::class)
        ->except(['show'])
        ->middleware(['can:manage categories']);

    // CRUD Blog Posts - hanya bisa diakses oleh user dengan permission 'manage posts'
    Route::resource('posts', AdminPostController::class)
        ->middleware(['can:manage posts']);

    // CRUD Works (Projek) - hanya bisa diakses oleh user dengan permission 'manage works'
    Route::resource('works', AdminWorkController::class)
        ->middleware(['can:manage works']);

    // CRUD Users - hanya bisa diakses oleh user dengan permission 'manage users'
    Route::resource('users', AdminUserController::class)->except(['show'])->middleware(['can:manage users']);
    
    // ================== AKHIR DARI PENAMBAHAN ==================

    // Rute profil tetap dapat diakses oleh semua user yang sudah login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';