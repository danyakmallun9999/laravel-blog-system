<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider_name')->nullable()->after('email'); // Nama provider (misal: 'google')
            $table->string('provider_id')->nullable()->unique()->after('provider_name'); // ID unik dari provider
            $table->string('avatar')->nullable()->after('provider_id'); // URL avatar pengguna
            $table->timestamp('email_verified_at')->nullable()->change(); // Pastikan ini sudah ada dan nullable
            $table->string('password')->nullable()->change(); // Membuat kolom password bisa null
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider_name', 'provider_id', 'avatar']);
            // Jika sebelumnya password tidak nullable, kembalikan state-nya
            // $table->string('password')->nullable(false)->change(); // Hati-hati dengan ini jika sudah ada user null password
        });
    }
};