<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard Admin</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                <a href="{{ route('dosen.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center hover:bg-indigo-50 transition">
                    <span class="text-2xl mb-1">Dosen</span>
                    <span class="text-2xl font-bold text-indigo-600">{{ $total_dosen }}</span>
                </a>
                <a href="{{ route('mahasiswa.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center hover:bg-green-50 transition">
                    <span class="text-2xl mb-1">Mahasiswa</span>
                    <span class="text-2xl font-bold text-green-600">{{ $total_mahasiswa }}</span>
                </a>
                <a href="{{ route('matakuliah.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center hover:bg-yellow-50 transition">
                    <span class="text-2xl mb-1">Mata Kuliah</span>
                    <span class="text-2xl font-bold text-yellow-600">{{ $total_matakuliah }}</span>
                </a>
                <a href="{{ route('jadwal.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center hover:bg-blue-50 transition">
                    <span class="text-2xl mb-1">Jadwal</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $total_jadwal }}</span>
                </a>
                <a href="{{ route('krs.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 flex flex-col items-center hover:bg-pink-50 transition">
                    <span class="text-2xl mb-1">KRS</span>
                    <span class="text-2xl font-bold text-pink-600">{{ $total_krs }}</span>
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">Jadwal Terbaru</h3>
                    <a href="{{ route('jadwal.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat semua</a>
                </div>
                <x-table>
                    <x-slot name="header">
                        <tr><th>#</th><th>Mata Kuliah</th><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th></tr>
                    </x-slot>
                    @forelse($jadwal_terbaru as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $j->dosen->nama ?? '-' }}</td>
                        <td>{{ $j->kelas }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-gray-400 py-6">Belum ada jadwal.</td></tr>
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>