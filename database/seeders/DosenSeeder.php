<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosens = [
            ['nidn' => '0101010101', 'nama' => 'Siti Nazilah, ST., M.Kom'],
            ['nidn' => '0202020202', 'nama' => 'M. Kanny Legiawan, ST., M.Kom'],
            ['nidn' => '0303030303', 'nama' => 'Ai Musyrifah, ST., M.Kom'],
            ['nidn' => '0404040404', 'nama' => 'Fuad Nasher, ST., M.Kom'],
            ['nidn' => '0505050505', 'nama' => 'Sutono,S.Si.,M.Kom'],
            ['nidn' => '0606060606', 'nama' => 'Siti Sarah A, ST., M.T'],
            ['nidn' => '0707070707', 'nama' => 'Tarmin Abdulghani, ST., M.T'],
            ['nidn' => '0808080808', 'nama' => 'Lalan Jaelani, ST., M.Kom'],
        ];

        foreach ($dosens as $d) {
            Dosen::updateOrCreate(['nidn' => $d['nidn']], $d);
        }
    }
}
