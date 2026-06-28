<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'mahasiswa']);

        // Create admin user
        $admin = User::updateOrCreate(
            ['npm' => 1000000001],
            [
                'npm'        => 1000000001,
                'username'   => 'admin',
                'first_name' => 'Admin',
                'last_name'  => 'SIAKAD',
                'email'      => 'admin@siakad.com',
                'password'   => Hash::make('password'),
            ]
        );
        $admin->syncRoles(['admin']);
    }
}
