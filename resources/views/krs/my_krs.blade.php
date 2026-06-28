<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">KRS Saya</h2></x-slot>
    <div class="py-12"><div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- Info Mahasiswa --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <div class="flex justify-between items-start">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">NPM:</span> <strong>{{ $mahasiswa->npm }}</strong></div>
                    <div><span class="text-gray-500">Nama:</span> <strong>{{ $mahasiswa->nama }}</strong></div>
                    <div><span class="text-gray-500">Semester ini MK:</span> <strong>{{ $krs_list->count() }}</strong></div>
                    <div><span class="text-gray-500">Total SKS:</span> <strong class="text-indigo-600 text-lg">{{ $total_sks }} SKS</strong></div>
                </div>
                <a href="{{ route('krs.my.pdf', $mahasiswa->npm) }}" target="_blank" class="text-sm text-indigo-600 hover:underline">📄 Export PDF</a>
            </div>
        </div>

        {{-- KRS Diambil --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 font-semibold text-gray-700 dark:text-gray-200">Mata Kuliah yang Diambil</div>
            <x-table>
                <x-slot name="header"><tr><th>#</th><th>Kode</th><th>Nama Mata Kuliah</th><th class="text-center">SKS</th><th>Aksi</th></tr></x-slot>
                @php $no = 1; @endphp
                @forelse($krs_list as $k)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><span class="font-mono text-sm">{{ $k->kode_matakuliah }}</span></td>
                        <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td class="text-center"><span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                        <td>
                            <form action="{{ route('krs.destroy', $k->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <x-danger-button onclick="return confirm('Drop mata kuliah ini dari KRS?')">Drop</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-gray-400">Belum ada KRS. Tambahkan mata kuliah di bawah.</td></tr>
                @endforelse
            </x-table>
        </div>

        {{-- Tambah MK --}}
        @if($tersedia->count() > 0)
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <h3 class="font-semibold text-gray-700 dark:text-gray-200 mb-4">Ambil Mata Kuliah</h3>
            <form method="POST" action="{{ route('krs.store') }}" class="flex gap-3 items-end">
                @csrf
                <div class="flex-1">
                    <x-input-label for="kode_matakuliah" value="Pilih Mata Kuliah"/>
                    <x-select-input id="kode_matakuliah" name="kode_matakuliah" class="mt-1 block w-full" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($tersedia as $mk)
                            <option value="{{ $mk->kode_matakuliah }}">{{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                        @endforeach
                    </x-select-input>
                </div>
                <x-primary-button type="submit">+ Tambah ke KRS</x-primary-button>
            </form>
        </div>
        @else
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-green-700 text-sm">
            ✅ Semua mata kuliah yang tersedia sudah Anda ambil.
        </div>
        @endif
    </div></div>
</x-app-layout>
