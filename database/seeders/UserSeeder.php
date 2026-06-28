<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'   => 'admin',
            'first_name' => 'Admin',
            'last_name'  => 'SIAKAD',
            'email'      => 'admin@siakad.ac.id',
            'password'   => Hash::make('password'),
            'role'       => 'admin',
            'npm'        => null,
        ]);

        User::create([
            'username'   => 'andi2024',
            'first_name' => 'Andi',
            'last_name'  => 'Pratama',
            'email'      => 'andi@mhs.siakad.ac.id',
            'password'   => Hash::make('password'),
            'role'       => 'mahasiswa',
            'npm'        => '2024010001',
        ]);

        User::create([
            'username'   => 'sari2024',
            'first_name' => 'Sari',
            'last_name'  => 'Dewi',
            'email'      => 'sari@mhs.siakad.ac.id',
            'password'   => Hash::make('password'),
            'role'       => 'mahasiswa',
            'npm'        => '2024010002',
        ]);
    }
}
