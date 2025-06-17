<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar Hak Akses (Permissions)
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage categories']);
        Permission::create(['name' => 'manage posts']);
        Permission::create(['name' => 'manage works']);

        // Daftar Peran (Roles)
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        // Peran Super Admin secara otomatis akan mendapatkan semua hak akses
        // melalui Gate::before() yang akan kita definisikan nanti.

        $blogWriterRole = Role::create(['name' => 'Penulis Blog']);
        $blogWriterRole->givePermissionTo([
            'manage posts',
            // 'manage categories' // (jika penulis juga boleh mengelola kategori)
        ]);

        $portfolioManagerRole = Role::create(['name' => 'Manajer Portfolio']);
        $portfolioManagerRole->givePermissionTo('manage works');
    }
}