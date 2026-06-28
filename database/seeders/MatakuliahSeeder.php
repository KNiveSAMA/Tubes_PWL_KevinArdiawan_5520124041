<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mks = [
            ['kode_matakuliah' => 'IF001', 'nama_matakuliah' => 'Interaksi Manusia dan Komputer', 'sks' => 3],
            ['kode_matakuliah' => 'IF002', 'nama_matakuliah' => 'Komunikasi Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF003', 'nama_matakuliah' => 'IT Governance', 'sks' => 3],
            ['kode_matakuliah' => 'IF004', 'nama_matakuliah' => 'Multimedia', 'sks' => 3],
            ['kode_matakuliah' => 'IF005', 'nama_matakuliah' => 'Basis Data II', 'sks' => 3],
            ['kode_matakuliah' => 'IF006', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
            ['kode_matakuliah' => 'IF007', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 3],
            ['kode_matakuliah' => 'IF008', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3],
        ];

        foreach ($mks as $mk) {
            Matakuliah::updateOrCreate(['kode_matakuliah' => $mk['kode_matakuliah']], $mk);
        }
    }
}
