<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            ['kode_matakuliah' => 'IF001', 'nidn' => '0101010101', 'kelas' => 'A', 'hari' => 'Senin',  'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF002', 'nidn' => '0202020202', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '10:00:00'],
            ['kode_matakuliah' => 'IF003', 'nidn' => '0303030303', 'kelas' => 'B', 'hari' => 'Rabu',   'jam' => '13:00:00'],
            ['kode_matakuliah' => 'IF004', 'nidn' => '0404040404', 'kelas' => 'A', 'hari' => 'Kamis',  'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF005', 'nidn' => '0505050505', 'kelas' => 'B', 'hari' => 'Jumat',  'jam' => '10:00:00'],
            ['kode_matakuliah' => 'IF006', 'nidn' => '0606060606', 'kelas' => 'A', 'hari' => 'Senin',  'jam' => '13:00:00'],
            ['kode_matakuliah' => 'IF007', 'nidn' => '0707070707', 'kelas' => 'C', 'hari' => 'Rabu',   'jam' => '08:00:00'],
            ['kode_matakuliah' => 'IF008', 'nidn' => '0808080808', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '13:00:00'],
        ];

        foreach ($jadwals as $j) {
            Jadwal::create($j);
        }
    }
}
