<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('dosen');
        if ($request->search) {
            $query->where('npm', 'like', "%{$request->search}%")
                  ->orWhere('nama', 'like', "%{$request->search}%");
        }
        $mahasiswas = $query->paginate(10)->withQueryString();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosens = Dosen::pluck('nama', 'nidn');
        return view('mahasiswa.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'      => 'required|string|max:10|unique:mahasiswa,npm',
            'nama'     => 'required|string|max:50',
            'nidn'     => 'nullable|exists:dosen,nidn',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'npm.required' => 'NPM wajib diisi.',
            'npm.unique'   => 'NPM sudah terdaftar.',
            'nama.required'=> 'Nama wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        Mahasiswa::create(['npm' => $request->npm, 'nama' => $request->nama, 'nidn' => $request->nidn]);

        $nameParts = explode(' ', $request->nama);
        $user = User::create([
            'npm'        => $request->npm,
            'username'   => $request->npm,
            'first_name' => $nameParts[0],
            'last_name'  => count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '-',
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);
        $user->assignRole('mahasiswa');

        return redirect()->route('mahasiswa.index')
            ->with(['message' => 'Data mahasiswa berhasil ditambahkan!', 'alert-type' => 'success']);
    }

    public function edit(string $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens    = Dosen::pluck('nama', 'nidn');
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, string $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $request->validate([
            'nama' => 'required|string|max:50',
            'nidn' => 'nullable|exists:dosen,nidn',
        ]);
        $mahasiswa->update($request->only('nama', 'nidn'));
        return redirect()->route('mahasiswa.index')
            ->with(['message' => 'Data mahasiswa berhasil diperbarui!', 'alert-type' => 'success']);
    }

    public function destroy(string $npm)
    {
        Mahasiswa::findOrFail($npm)->delete();
        User::where('npm', $npm)->delete();
        return redirect()->route('mahasiswa.index')
            ->with(['message' => 'Data mahasiswa berhasil dihapus!', 'alert-type' => 'success']);
    }
}
