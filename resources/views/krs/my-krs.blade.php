<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">KRS Saya</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Ambil Mata Kuliah</h3>
                        @if($matakuliah_tersedia->count() > 0)
                        <form method="POST" action="{{ route('krs.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Mata Kuliah</label>
                                <select name="kode_matakuliah" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                                    <option value="">-- Pilih --</option>
                                    @foreach($matakuliah_tersedia as $mk)
                                    <option value="{{ $mk->kode_matakuliah }}">{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                                    @endforeach
                                </select>
                                @error('kode_matakuliah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Ambil Mata Kuliah</button>
                        </form>
                        @else
                        <p class="text-sm text-gray-500">Semua mata kuliah sudah diambil.</p>
                        @endif
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                                Daftar KRS <span class="text-sm font-normal text-gray-500">| Total SKS: <strong class="text-indigo-600">{{ $total_sks }}</strong></span>
                            </h3>
                            @if($krs_list->count() > 0)
                            <a href="{{ route('krs.export') }}" class="px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition">Export PDF</a>
                            @endif
                        </div>
                        <x-table>
                            <x-slot name="header">
                                <tr><th>#</th><th>Kode</th><th>Nama Mata Kuliah</th><th class="text-center">SKS</th><th>Aksi</th></tr>
                            </x-slot>
                            @forelse($krs_list as $krs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="font-mono bg-gray-100 px-2 py-0.5 rounded text-sm">{{ $krs->kode_matakuliah }}</span></td>
                                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center font-bold">{{ $krs->matakuliah->sks ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('krs.my.destroy', $krs->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin drop mata kuliah ini?')" class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700">Drop</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-gray-400 py-6">Belum ada KRS.</td></tr>
                            @endforelse
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>