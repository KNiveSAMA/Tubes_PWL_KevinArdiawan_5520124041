<?php
namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::query();
        if ($request->search) {
            $query->where('kode_matakuliah', 'like', "%{$request->search}%")
                  ->orWhere('nama_matakuliah', 'like', "%{$request->search}%");
        }
        $matakuliahs = $query->paginate(10)->withQueryString();
        return view('matakuliah.index', compact('matakuliahs'));
    }

    public function create() { return view('matakuliah.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ], [
            'kode_matakuliah.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_matakuliah.unique'   => 'Kode Mata Kuliah sudah terdaftar.',
            'nama_matakuliah.required' => 'Nama Mata Kuliah wajib diisi.',
            'sks.required'             => 'SKS wajib diisi.',
        ]);
        Matakuliah::create($request->only('kode_matakuliah', 'nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')
            ->with(['message' => 'Mata kuliah berhasil ditambahkan!', 'alert-type' => 'success']);
    }

    public function edit(string $kode)
    {
        $matakuliah = Matakuliah::findOrFail($kode);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, string $kode)
    {
        $matakuliah = Matakuliah::findOrFail($kode);
        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ]);
        $matakuliah->update($request->only('nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')
            ->with(['message' => 'Mata kuliah berhasil diperbarui!', 'alert-type' => 'success']);
    }

    public function destroy(string $kode)
    {
        Matakuliah::findOrFail($kode)->delete();
        return redirect()->route('matakuliah.index')
            ->with(['message' => 'Mata kuliah berhasil dihapus!', 'alert-type' => 'success']);
    }
}
