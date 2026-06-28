<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['matakuliah', 'dosen']);
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->whereHas('matakuliah', fn($q2) => $q2->where('nama_matakuliah', 'like', "%{$request->search}%"))
                  ->orWhereHas('dosen', fn($q2) => $q2->where('nama', 'like', "%{$request->search}%"))
                  ->orWhere('hari', 'like', "%{$request->search}%")
                  ->orWhere('kelas', 'like', "%{$request->search}%");
            });
        }
        if ($request->hari) {
            $query->where('hari', $request->hari);
        }
        $jadwals = $query->paginate(10)->withQueryString();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $matakuliahs = Matakuliah::pluck('nama_matakuliah', 'kode_matakuliah');
        $dosens      = Dosen::pluck('nama', 'nidn');
        return view('jadwal.create', compact('matakuliahs', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|string|max:1',
            'hari'            => 'required|string|max:10',
            'jam'             => 'required',
        ]);
        Jadwal::create($request->only('kode_matakuliah', 'nidn', 'kelas', 'hari', 'jam'));
        return redirect()->route('jadwal.index')
            ->with(['message' => 'Jadwal berhasil ditambahkan!', 'alert-type' => 'success']);
    }

    public function edit(int $id)
    {
        $jadwal      = Jadwal::findOrFail($id);
        $matakuliahs = Matakuliah::pluck('nama_matakuliah', 'kode_matakuliah');
        $dosens      = Dosen::pluck('nama', 'nidn');
        return view('jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens'));
    }

    public function update(Request $request, int $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|string|max:1',
            'hari'            => 'required|string|max:10',
            'jam'             => 'required',
        ]);
        $jadwal->update($request->only('kode_matakuliah', 'nidn', 'kelas', 'hari', 'jam'));
        return redirect()->route('jadwal.index')
            ->with(['message' => 'Jadwal berhasil diperbarui!', 'alert-type' => 'success']);
    }

    public function destroy(int $id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')
            ->with(['message' => 'Jadwal berhasil dihapus!', 'alert-type' => 'success']);
    }
}
