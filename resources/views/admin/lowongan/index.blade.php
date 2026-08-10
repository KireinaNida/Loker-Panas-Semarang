@extends('layouts.admin')

@section('title', 'Kelola Lowongan - Admin Info Loker Panas')
@section('page-title', 'Kelola Lowongan Kerja')
@section('page-subtitle', 'Kelola dan pantau seluruh postingan lowongan kerja yang aktif di platform')

@section('topbar-actions')
    <a href="{{ route('admin.lowongan.create') }}" class="px-4 py-2.5 rounded-xl bg-orange-400 hover:bg-orange-500 text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5">
        <svg class="icon w-3.5 h-3.5"><use href="#icon-plus"/></svg> Tambah Lowongan Baru
    </a>
@endsection

@section('content')

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Posisi Pekerjaan</th>
                        <th class="px-6 py-4">Perusahaan</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4">Batas Lamar</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($lowongan as $l)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-900">
                            <a href="{{ route('lowongan.show', $l->id) }}" class="hover:text-orange-500 transition-colors">
                                {{ $l->nama_posisi }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-slate-700 font-medium">
                            {{ $l->nama_perusahaan }}
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs font-semibold">
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200">
                                {{ $l->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs">
                            <span class="flex items-center gap-1">
                                <svg class="icon w-3.5 h-3.5 text-slate-400"><use href="#icon-pin"/></svg>
                                {{ $l->lokasi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs font-medium">
                            {{ $l->batas_lamar ? \Carbon\Carbon::parse($l->batas_lamar)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $l->status === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-200 text-gray-700' }}">
                                {{ ucfirst($l->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.lowongan.edit', $l->id) }}" class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:border-orange-300 transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.lowongan.destroy', $l->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan {{ addslashes($l->nama_posisi) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-xl border border-rose-200 bg-rose-50 text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-xs text-slate-500">
                            Belum ada lowongan terdaftar. Silakan buat postingan lowongan baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection