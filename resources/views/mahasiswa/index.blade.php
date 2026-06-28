<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Data Mahasiswa</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex gap-2 flex-wrap items-center justify-between">
                <a href="{{ route('mahasiswa.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">+ Tambah Mahasiswa</a>
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NPM / Nama..." class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"/>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Cari</button>
                    @if(request('search'))<a href="{{ route('mahasiswa.index') }}" class="px-3 py-2 text-sm text-gray-500 border rounded-lg hover:bg-gray-50">Reset</a>@endif
                </form>
            </div>
            <x-table>
                <x-slot name="header">
                    <tr><th>#</th><th>NPM</th><th>Nama</th><th>Dosen Wali</th><th>Aksi</th></tr>
                </x-slot>
                @forelse($mahasiswas as $mhs)
                <tr>
                    <td>{{ $loop->iteration + ($mahasiswas->currentPage()-1) * $mahasiswas->perPage() }}</td>
                    <td class="font-mono text-sm">{{ $mhs->npm }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->dosen->nama ?? '-' }}</td>
                    <td class="flex gap-2">
                        <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded-lg hover:bg-indigo-700">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus mahasiswa ini?')" class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-gray-400 py-6">Belum ada data mahasiswa.</td></tr>
                @endforelse
            </x-table>
            <div class="mt-4">{{ $mahasiswas->links() }}</div>
        </div>
    </div>
</x-app-layout>