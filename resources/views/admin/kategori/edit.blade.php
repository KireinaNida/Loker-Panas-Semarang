<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="block mb-1 font-medium">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="w-full border rounded p-2 mb-4" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                    @error('nama_kategori') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

                    <button type="submit" class="px-4 py-2 bg-[#1F2A44] text-white rounded">Update</button>
                    <a href="{{ route('admin.kategori.index') }}" class="px-4 py-2 border rounded">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>