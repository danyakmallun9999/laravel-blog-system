<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder dalam urutan yang benar:
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,     // User dulu, agar PostSeeder bisa mendapatkan user_id
            CategorySeeder::class, // Kategori dulu, agar PostSeeder bisa mendapatkan category_id
            PostSeeder::class,     // Post setelah User dan Category
            WorkSeeder::class,     // Work bisa kapan saja karena tidak ada dependensi foreign key langsung ke user/category saat ini
        ]);

        // Anda bisa juga memanggil factory langsung dari sini jika tidak butuh logika khusus di seeder:
        // \App\Models\User::factory(10)->create();
        // \App\Models\Post::factory(20)->create();
    }
}
