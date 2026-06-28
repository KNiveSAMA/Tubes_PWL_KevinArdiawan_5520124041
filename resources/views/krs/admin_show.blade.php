<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail KRS - {{ $mahasiswa->nama }}</h2>
            <div class="flex gap-2">
                <x-secondary-button tag="a" href="{{ route('krs.pdf', $mahasiswa->npm) }}" target="_blank">📄 Export PDF</x-secondary-button>
                <x-secondary-button tag="a" href="{{ route('krs.admin.index') }}">← Kembali</x-secondary-button>
            </div>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">NPM:</span> <strong>{{ $mahasiswa->npm }}</strong></div>
                <div><span class="text-gray-500">Nama:</span> <strong>{{ $mahasiswa->nama }}</strong></div>
                <div><span class="text-gray-500">Total SKS:</span> <strong class="text-indigo-600">{{ $total_sks }} SKS</strong></div>
                <div><span class="text-gray-500">Jumlah MK:</span> <strong>{{ $krs_list->count() }} Mata Kuliah</strong></div>
            </div>
        </div>
        <x-table>
            <x-slot name="header"><tr><th>#</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th class="text-center">SKS</th></tr></x-slot>
            @php $no = 1; @endphp
            @forelse($krs_list as $k)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><span class="font-mono text-sm">{{ $k->kode_matakuliah }}</span></td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="text-center"><span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-gray-400">Belum ada KRS.</td></tr>
            @endforelse
        </x-table>
    </div></div>
</x-app-layout>
