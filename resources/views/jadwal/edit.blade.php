<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Jadwal</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}" class="space-y-5">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mata Kuliah</label>
                        <select name="kode_matakuliah" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            @foreach($matakuliahs as $kode => $nama)
                            <option value="{{ $kode }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $kode ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('kode_matakuliah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dosen Pengajar</label>
                        <select name="nidn" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            @foreach($dosens as $nidn => $nama)
                            <option value="{{ $nidn }}" {{ old('nidn', $jadwal->nidn) == $nidn ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('nidn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelas</label>
                        <select name="kelas" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            @foreach(['A','B','C','D','E'] as $k)
                            <option value="{{ $k }}" {{ old('kelas', $jadwal->kelas) == $k ? 'selected' : '' }}>Kelas {{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hari</label>
                        <select name="hari" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                            <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jam Mulai</label>
                        <input type="time" name="jam" value="{{ old('jam', \Carbon\Carbon::parse($jadwal->jam)->format('H:i')) }}" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"/>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('jadwal.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>