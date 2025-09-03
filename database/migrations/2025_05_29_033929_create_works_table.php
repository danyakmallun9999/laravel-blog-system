<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_works_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable(); // Path ke gambar projek
            $table->string('year', 4); // Tahun projek, misal "2024"
            $table->string('category'); // Kategori projek, misal "Web Development", "UI/UX Design"
            // Jika ingin kategori work lebih terstruktur, bisa dibuat tabel categories_work terpisah
            // dan relasi seperti pada Post. Untuk saat ini, kita buat string sederhana.
            $table->string('project_url')->nullable(); // URL ke projek (live atau repository)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
