<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard — Selamat datang, {{ auth()->user()->first_name }}!
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($mahasiswa)
            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center">
                    <span class="text-3xl mb-1">📋</span>
                    <span class="text-2xl font-bold text-indigo-600">{{ $krs_list->count() }}</span>
                    <span class="text-sm text-gray-500 mt-1">Mata Kuliah Diambil</span>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center">
                    <span class="text-3xl mb-1">🔢</span>
                    <span class="text-2xl font-bold text-green-600">{{ $total_sks }}</span>
                    <span class="text-sm text-gray-500 mt-1">Total SKS</span>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center">
                    <span class="text-3xl mb-1">🗓️</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $jadwal->count() }}</span>
                    <span class="text-sm text-gray-500 mt-1">Jadwal Aktif</span>
                </div>
            </div>

            {{-- Info & Quick Links --}}
            <div class="grid md:grid-cols-2 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Info Mahasiswa</h3>
                    <table class="w-full text-sm">
                        <tr><td class="py-1 text-gray-500 w-32">NPM</td><td class="font-mono font-medium">{{ $mahasiswa->npm }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Nama</td><td class="font-medium">{{ $mahasiswa->nama }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Dosen Wali</td><td>{{ $mahasiswa->dosen->nama ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('krs.my') }}" class="flex-1 bg-indigo-600 text-white rounded-xl shadow p-5 flex flex-col items-center justify-center hover:bg-indigo-700 transition text-center">
                        <span class="text-3xl mb-2">📋</span>
                        <span class="font-semibold">Kelola KRS</span>
                        <span class="text-xs mt-1 opacity-80">Ambil / Drop MK</span>
                    </a>
                    <a href="{{ route('jadwal.lihat') }}" class="flex-1 bg-green-600 text-white rounded-xl shadow p-5 flex flex-col items-center justify-center hover:bg-green-700 transition text-center">
                        <span class="text-3xl mb-2">🗓️</span>
                        <span class="font-semibold">Jadwal Kuliah</span>
                        <span class="text-xs mt-1 opacity-80">Lihat semua</span>
                    </a>
                </div>
            </div>

            {{-- KRS & Jadwal --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">KRS Saya</h3>
                        <a href="{{ route('krs.my') }}" class="text-sm text-indigo-600 hover:underline">Kelola →</a>
                    </div>
                    <x-table>
                        <x-slot name="header">
                            <tr><th>#</th><th>Mata Kuliah</th><th class="text-center">SKS</th></tr>
                        </x-slot>
                        @forelse($krs_list as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="text-center font-bold">{{ $k->matakuliah->sks ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-gray-400 py-4">Belum ada KRS. <a href="{{ route('krs.my') }}" class="text-indigo-600 hover:underline">Ambil sekarang</a></td></tr>
                        @endforelse
                    </x-table>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">Jadwal Kuliah</h3>
                        <a href="{{ route('jadwal.lihat') }}" class="text-sm text-indigo-600 hover:underline">Lihat semua →</a>
                    </div>
                    <x-table>
                        <x-slot name="header">
                            <tr><th>Mata Kuliah</th><th>Hari</th><th>Jam</th><th class="text-center">Kelas</th></tr>
                        </x-slot>
                        @forelse($jadwal as $j)
                        <tr>
                            <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td>{{ $j->hari }}</td>
                            <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                            <td class="text-center font-bold text-indigo-600">{{ $j->kelas }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-gray-400 py-4">Belum ada jadwal.</td></tr>
                        @endforelse
                    </x-table>
                </div>
            </div>

            @else
            {{-- Akun belum terhubung --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center">
                <div class="text-4xl mb-3">⚠️</div>
                <h3 class="font-semibold text-yellow-800 text-lg mb-2">Akun Belum Terhubung</h3>
                <p class="text-yellow-700 text-sm">Akun Anda belum terhubung ke data mahasiswa. Silakan hubungi Admin.</p>
                <p class="text-yellow-600 text-xs mt-2">NPM: {{ auth()->user()->npm }}</p>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
