<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus kategori yang mungkin sudah ada (opsional)
        // Category::truncate(); // Hati-hati, ini menghapus semua data di tabel kategori

        $categories = [
            ['name' => 'Web Development'],
            ['name' => 'Crypto'],
            ['name' => 'Tutorials'],
            ['name' => 'Laravel'],
            ['name' => 'JavaScript'],
            ['name' => 'Personal'],
            ['name' => 'UI/UX Design'],
        ];

        foreach ($categories as $category) {
            Category::create($category); // Slug akan dibuat otomatis oleh model
        }
    }
}
