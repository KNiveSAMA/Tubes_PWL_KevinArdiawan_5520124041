<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();
        if ($request->search) {
            $query->where('nidn', 'like', "%{$request->search}%")
                  ->orWhere('nama', 'like', "%{$request->search}%");
        }
        $dosens = $query->paginate(10)->withQueryString();
        return view('dosen.index', compact('dosens'));
    }

    public function create() { return view('dosen.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique'   => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
        ]);
        Dosen::create($request->only('nidn', 'nama'));
        return redirect()->route('dosen.index')
            ->with(['message' => 'Data dosen berhasil ditambahkan!', 'alert-type' => 'success']);
    }

    public function edit(string $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $request->validate(['nama' => 'required|string|max:50']);
        $dosen->update($request->only('nama'));
        return redirect()->route('dosen.index')
            ->with(['message' => 'Data dosen berhasil diperbarui!', 'alert-type' => 'success']);
    }

    public function destroy(string $nidn)
    {
        Dosen::findOrFail($nidn)->delete();
        return redirect()->route('dosen.index')
            ->with(['message' => 'Data dosen berhasil dihapus!', 'alert-type' => 'success']);
    }
}
