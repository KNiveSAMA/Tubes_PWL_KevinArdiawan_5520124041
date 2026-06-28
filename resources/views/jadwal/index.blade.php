<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Jadwal Perkuliahan</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex gap-2 flex-wrap items-center justify-between">
                @role('admin')
                <a href="{{ route('jadwal.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">+ Tambah Jadwal</a>
                @endrole
                <form method="GET" class="flex gap-2 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mata kuliah / dosen..." class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"/>
                    <select name="hari" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                        <option value="">Semua Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                        <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Filter</button>
                    @if(request('search') || request('hari'))<a href="{{ url()->current() }}" class="px-3 py-2 text-sm text-gray-500 border rounded-lg hover:bg-gray-50">Reset</a>@endif
                </form>
            </div>
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th><th>Mata Kuliah</th><th>Dosen</th>
                        <th class="text-center">Kelas</th><th>Hari</th><th>Jam</th>
                        @role('admin')<th>Aksi</th>@endrole
                    </tr>
                </x-slot>
                @forelse($jadwals as $j)
                <tr>
                    <td>{{ $loop->iteration + ($jadwals->currentPage()-1) * $jadwals->perPage() }}</td>
                    <td>
                        <div class="font-medium">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                        <div class="text-xs text-gray-400 font-mono">{{ $j->kode_matakuliah }}</div>
                    </td>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="text-center font-bold text-indigo-600">{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }} WIB</td>
                    @role('admin')
                    <td class="flex gap-2">
                        <a href="{{ route('jadwal.edit', $j->id) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded-lg hover:bg-indigo-700">Edit</a>
                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus jadwal ini?')" class="px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                    @endrole
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-gray-400 py-6">Belum ada jadwal.</td></tr>
                @endforelse
            </x-table>
            <div class="mt-4">{{ $jadwals->links() }}</div>
        </div>
    </div>
</x-app-layout>