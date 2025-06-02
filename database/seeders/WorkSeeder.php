<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus works yang mungkin sudah ada (opsional)
        // Work::truncate();

        // Buat 8 proyek portfolio sampel menggunakan factory
        Work::factory()->count(8)->create();
    }
}