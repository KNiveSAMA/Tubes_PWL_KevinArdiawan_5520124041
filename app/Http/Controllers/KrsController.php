<?php
namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    // Admin: lihat semua KRS
    public function index(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'matakuliah']);
        if ($request->npm) {
            $query->where('npm', $request->npm);
        }
        $krs_list   = $query->paginate(15)->withQueryString();
        $mahasiswas = Mahasiswa::pluck('nama', 'npm');
        return view('krs.index', compact('krs_list', 'mahasiswas'));
    }

    // Mahasiswa: lihat & kelola KRS sendiri
    public function myKrs()
    {
        $npm       = auth()->user()->npm;
        $krs_list  = Krs::with('matakuliah')->where('npm', $npm)->get();
        $total_sks = $krs_list->sum(fn($k) => $k->matakuliah->sks ?? 0);
        $diambil   = $krs_list->pluck('kode_matakuliah');
        $matakuliah_tersedia = Matakuliah::whereNotIn('kode_matakuliah', $diambil)->get();
        return view('krs.my-krs', compact('krs_list', 'total_sks', 'matakuliah_tersedia'));
    }

    // Mahasiswa: ambil mata kuliah
    public function store(Request $request)
    {
        $npm = auth()->user()->npm;
        $request->validate(['kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah']);

        if (Krs::where('npm', $npm)->where('kode_matakuliah', $request->kode_matakuliah)->exists()) {
            return back()->with(['message' => 'Mata kuliah sudah ada di KRS!', 'alert-type' => 'warning']);
        }

        Krs::create(['npm' => $npm, 'kode_matakuliah' => $request->kode_matakuliah]);
        return back()->with(['message' => 'Mata kuliah berhasil ditambahkan ke KRS!', 'alert-type' => 'success']);
    }

    // Drop / hapus KRS (admin & mahasiswa)
    public function destroy(int $id)
    {
        $krs = Krs::findOrFail($id);
        if (auth()->user()->hasRole('mahasiswa') && $krs->npm != auth()->user()->npm) {
            abort(403, 'Anda tidak berhak menghapus KRS ini.');
        }
        $krs->delete();
        return back()->with(['message' => 'KRS berhasil dihapus!', 'alert-type' => 'success']);
    }

    // Export KRS ke PDF
    public function exportPdf(string $npm = null)
    {
        if (auth()->user()->hasRole('mahasiswa')) {
            $npm = auth()->user()->npm;
        }
        $mahasiswa = Mahasiswa::with('dosen')->findOrFail($npm);
        $krs_list  = Krs::with('matakuliah')->where('npm', $npm)->get();
        $total_sks = $krs_list->sum(fn($k) => $k->matakuliah->sks ?? 0);
        $pdf = Pdf::loadView('krs.print', compact('mahasiswa', 'krs_list', 'total_sks'));
        return $pdf->download("KRS_{$npm}.pdf");
    }
}
