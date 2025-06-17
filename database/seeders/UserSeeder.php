<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import model User

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Menggunakan Eloquent Model
        $user = User::create([
            'name' => 'Dany Akmallun Niam',
            'email' => 'danyakmallun9999@gmail.com',
            'password' => Hash::make('daN00b-9999'),
            'email_verified_at' => now(),
        ]);

        // Atau menggunakan Query Builder
        // DB::table('users')->insert([
        //     'name' => 'Admin Utama',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password123'),
        //     'email_verified_at' => now(),
        // ]);

        $user->assignRole('Super Admin');
    }
}