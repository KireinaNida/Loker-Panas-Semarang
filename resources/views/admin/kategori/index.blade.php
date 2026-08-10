@extends('layouts.admin')

@section('title', 'Kelola Kategori - Admin Info Loker Panas')
@section('page-title', 'Kelola Kategori')
@section('page-subtitle', 'Total ' . $kategoris->count() . ' kategori pekerjaan terdaftar')

@section('content')

    <div x-data="{ showModal: false, editMode: false, editId: null, namaKategori: '' }">

        <div class="flex justify-end mb-4">
            <button @click="showModal = true; editMode = false; namaKategori = ''"
                    class="px-4 py-2.5 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5">
                <svg class="icon w-3.5 h-3.5"><use href="#icon-plus"/></svg> Tambah Kategori Baru
            </button>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4 text-center">Jumlah Lowongan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($kategoris as $k)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-900">
                                <span class="flex items-center gap-2">
                                    <svg class="icon w-4 h-4 text-orange-400"><use href="#icon-folder"/></svg>
                                    {{ $k->nama_kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-700">
                                    {{ $k->lowongan_count }} Lowongan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="showModal = true; editMode = true; editId = {{ $k->id }}; namaKategori = '{{ addslashes($k->nama_kategori) }}'"
                                        class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:border-orange-300 transition-colors">
                                    Edit
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus kategori {{ addslashes($k->nama_kategori) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl border border-rose-200 bg-rose-50 text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-xs text-slate-500">
                                Belum ada kategori. Tambahkan kategori pertama Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah / Edit -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-md p-6 sm:p-8 z-10">
                <h3 class="font-bold text-xl text-slate-900 mb-2" x-text="editMode ? 'Edit Kategori' : 'Tambah Kategori Baru'"></h3>
                <p class="text-xs text-slate-500 mb-6">Masukkan nama kategori pekerjaan yang ingin ditambahkan.</p>

                <form :action="editMode ? '/admin/kategori/' + editId : '{{ route('admin.kategori.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Kategori</label>
                        <input type="text" name="nama_kategori" x-model="namaKategori" required
                               class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 focus:bg-white focus:border-orange-400 outline-none"
                               placeholder="Contoh: IT & Software">
                    </div>

                    <div class="flex gap-2 justify-end pt-2">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-orange-400 text-white text-xs font-bold hover:bg-orange-500 transition-colors shadow-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection