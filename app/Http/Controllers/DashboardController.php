<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('dashboard.admin', [
                'total_dosen'      => Dosen::count(),
                'total_mahasiswa'  => Mahasiswa::count(),
                'total_matakuliah' => Matakuliah::count(),
                'total_jadwal'     => Jadwal::count(),
                'total_krs'        => Krs::count(),
                'jadwal_terbaru'   => Jadwal::with(['matakuliah', 'dosen'])->latest()->take(5)->get(),
            ]);
        }

        // Mahasiswa
        $npm       = auth()->user()->npm;
        $mahasiswa = Mahasiswa::with('dosen')->where('npm', $npm)->first();
        $krs_list  = $mahasiswa
                        ? Krs::with('matakuliah')->where('npm', $npm)->get()
                        : collect();
        $jadwal    = $krs_list->isNotEmpty()
                        ? Jadwal::with(['matakuliah', 'dosen'])
                              ->whereIn('kode_matakuliah', $krs_list->pluck('kode_matakuliah'))
                              ->get()
                        : collect();
        $total_sks = $krs_list->sum(fn($k) => $k->matakuliah->sks ?? 0);
        $krs       = $krs_list; // alias for view

        return view('dashboard.mahasiswa', compact('mahasiswa', 'krs', 'krs_list', 'jadwal', 'total_sks'));
    }
}
