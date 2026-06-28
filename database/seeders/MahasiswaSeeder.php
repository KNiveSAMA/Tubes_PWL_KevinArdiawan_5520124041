<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = [
            ['npm' => '5520124041', 'nama' => 'Kevin Ardiawan',     'nidn' => '0404040404', 'email' => 'vin@mhs.siakad.com'],
            ['npm' => '5520125002', 'nama' => 'Abigail Rachel',     'nidn' => '0101010101', 'email' => 'ayayi@mhs.siakad.com'],
            ['npm' => '5520125041', 'nama' => 'Catherina Valencia', 'nidn' => '0101010101', 'email' => 'caca@mhs.siakad.com'],
            ['npm' => '5520125054', 'nama' => 'Hilary Abigail',     'nidn' => '0101010101', 'email' => 'lily@mhs.siakad.com'],
            ['npm' => '5520125055', 'nama' => 'Adeline Wijaya',     'nidn' => '0404040404', 'email' => 'lin@mhs.siakad.com'],
        ];

        foreach ($mahasiswas as $m) {
            Mahasiswa::updateOrCreate(['npm' => $m['npm']], [
                'npm'  => $m['npm'],
                'nama' => $m['nama'],
                'nidn' => $m['nidn'],
            ]);

            $nameParts = explode(' ', $m['nama']);
            $user = User::updateOrCreate(
                ['npm' => $m['npm']],
                [
                    'npm'        => $m['npm'],
                    'username'   => $m['npm'],
                    'first_name' => $nameParts[0],
                    'last_name'  => count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '-',
                    'email'      => $m['email'],
                    'password'   => Hash::make('password'),
                ]
            );
            $user->syncRoles(['mahasiswa']);
        }
    }
}
