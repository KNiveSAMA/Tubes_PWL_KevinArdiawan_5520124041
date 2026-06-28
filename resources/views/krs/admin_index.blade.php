<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">KRS Mahasiswa</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari NPM atau Nama..." class="border-gray-300 rounded-md shadow-sm text-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 w-64">
            <x-primary-button type="submit">Cari</x-primary-button>
            @if($search)<a href="{{ route('krs.admin.index') }}" class="px-3 py-2 text-sm text-gray-600">Reset</a>@endif
        </form>
        <x-table>
            <x-slot name="header"><tr><th>#</th><th>NPM</th><th>Nama</th><th class="text-center">Jumlah MK</th><th class="text-center">Total SKS</th><th>Aksi</th></tr></x-slot>
            @php $no = ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + 1; @endphp
            @forelse($mahasiswa as $m)
                @php $sks = $m->krs->sum(fn($k) => $k->matakuliah->sks ?? 0); @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $m->npm }}</td>
                    <td>{{ $m->nama }}</td>
                    <td class="text-center">{{ $m->krs->count() }} MK</td>
                    <td class="text-center"><span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded">{{ $sks }} SKS</span></td>
                    <td class="flex gap-2">
                        <x-primary-button tag="a" href="{{ route('krs.admin.show', $m->npm) }}">Detail</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('krs.pdf', $m->npm) }}" target="_blank">PDF</x-secondary-button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-gray-400">Tidak ada data mahasiswa.</td></tr>
            @endforelse
        </x-table>
        <div class="mt-4">{{ $mahasiswa->links() }}</div>
    </div></div>
</x-app-layout>
