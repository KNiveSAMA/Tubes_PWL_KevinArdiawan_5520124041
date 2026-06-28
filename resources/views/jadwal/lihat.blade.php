<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Jadwal Kuliah</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" class="mb-4 flex gap-2">
            <select name="hari" class="border-gray-300 rounded-md shadow-sm text-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                    <option value="{{ $h }}" {{ $hari == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
            <x-primary-button type="submit">Filter</x-primary-button>
            @if($hari)<a href="{{ route('jadwal.lihat') }}" class="px-3 py-2 text-sm text-gray-600">Reset</a>@endif
        </form>
        <x-table>
            <x-slot name="header"><tr><th>#</th><th>Mata Kuliah</th><th>SKS</th><th>Dosen</th><th class="text-center">Kelas</th><th>Hari</th><th>Jam</th></tr></x-slot>
            @php $no = 1; @endphp
            @forelse($jadwal as $j)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="text-center">{{ $j->matakuliah->sks ?? '-' }}</td>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="text-center"><span class="bg-blue-100 text-blue-700 text-sm font-bold px-2 py-1 rounded">{{ $j->kelas }}</span></td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-gray-400">Tidak ada jadwal.</td></tr>
            @endforelse
        </x-table>
    </div></div>
</x-app-layout>
