<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

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
