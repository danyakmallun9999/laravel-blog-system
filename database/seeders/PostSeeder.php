<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada minimal 1 user dan beberapa kategori sebelum menjalankan ini
        if (User::count() == 0) {
            $this->command->warn('No users found. Please run UserSeeder first or ensure users exist.');
            // $this->call(UserSeeder::class); // Alternatif: panggil UserSeeder dari sini
            return;
        }
        if (Category::count() == 0) {
            $this->command->warn('No categories found. Please run CategorySeeder first or ensure categories exist.');
            // $this->call(CategorySeeder::class); // Alternatif
            return;
        }

        // Hapus postingan yang mungkin sudah ada (opsional)
        // Post::truncate();

        // Buat 15 postingan sampel menggunakan factory
        Post::factory()->count(15)->create();
    }
}