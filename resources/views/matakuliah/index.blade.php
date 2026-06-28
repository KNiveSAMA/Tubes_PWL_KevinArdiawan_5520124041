<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Data Mata Kuliah</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex gap-2 flex-wrap items-center justify-between">
                <a href="{{ route('matakuliah.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">+ Tambah Mata Kuliah</a>
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / nama..." class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"/>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Cari</button>
                    @if(request('search'))<a href="{{ route('matakuliah.index') }}" class="px-3 py-2 text-sm text-gray-500 border rounded-lg hover:bg-gray-50">Reset</a>@endif
                </form>
            </div>
            <x-table>
                <x-slot name="header">
                    <tr><th>#</th><th>Kode</th><th>Nama Mata Kuliah</th><th class="text-center">SKS</th><th>Aksi</th></tr>
                </x-slot>
                @forelse($matakuliahs as $mk)
                <tr>
                    <td>{{ $loop->iteration + ($matakuliahs->currentPage()-1) * $matakuliahs->perPage() }}</td>
                    <td><span class="font-mono bg-gray-100 px-2 py-0.5 rounded text-sm">{{ $mk->kode_matakuliah }}</span></td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td class="text-center font-bold">{{ $mk->sks }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded-lg hover:bg-indigo-700">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-gray-400 py-6">Belum ada data mata kuliah.</td></tr>
                @endforelse
            </x-table>
            <div class="mt-4">{{ $matakuliahs->links() }}</div>
        </div>
    </div>
</x-app-layout>