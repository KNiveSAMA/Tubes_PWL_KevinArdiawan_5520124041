<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Dosen</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <form method="POST" action="{{ route('dosen.update', $dosen->nidn) }}" class="space-y-5">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIDN</label>
                        <input type="text" value="{{ $dosen->nidn }}" disabled class="w-full border rounded-lg px-3 py-2 text-sm bg-gray-100"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" maxlength="50" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"/>
                        @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('dosen.index') }}" class="px-4 py-2 border rounded-lg text-sm text-gray-600 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>