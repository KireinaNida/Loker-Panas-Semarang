@extends('layouts.admin')

@section('title', 'Dashboard Admin - Info Loker Panas')
@section('page-title', 'Dashboard Ringkasan')
@section('page-subtitle', 'Ringkasan aktivitas dan lowongan kerja')

@section('content')

    <!-- STATS -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-500">Total Lowongan</span>
                <div class="w-9 h-9 rounded-lg bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-500">
                    <svg class="icon w-4 h-4"><use href="#icon-briefcase"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalLowongan }}</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-500">Total Kategori</span>
                <div class="w-9 h-9 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600">
                    <svg class="icon w-4 h-4"><use href="#icon-tag"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalKategori }}</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-500">Lowongan Aktif</span>
                <div class="w-9 h-9 rounded-lg bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-500">
                    <svg class="icon w-4 h-4"><use href="#icon-flame"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-orange-500">{{ $lowonganAktif }}</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-500">Interaksi Klik Lamar</span>
                <div class="w-9 h-9 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-500">
                    <svg class="icon w-4 h-4"><use href="#icon-click"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalKlikLamar }}</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-slate-500">Total Favorit</span>
                <div class="w-9 h-9 rounded-lg bg-rose-50 border border-rose-200 flex items-center justify-center text-rose-500">
                    <svg class="icon w-4 h-4"><use href="#icon-heart"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $totalFavorit }}</p>
        </div>
    </div>

    <!-- TABEL LOWONGAN TERBARU -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
        <div class="flex justify-between items-center p-6 pb-4">
            <div>
                <h3 class="font-bold text-base text-slate-900">Lowongan Kerja Terbaru</h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar postingan lowongan kerja yang baru saja ditambahkan</p>
            </div>
            <a href="{{ route('admin.lowongan.index') }}" class="text-xs font-bold text-orange-500 hover:underline">Lihat Semua &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-t border-slate-100 text-xs text-slate-500">
                        <th class="px-6 py-3 font-medium">Posisi</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Diposting</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowonganTerbaru as $l)
                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-500 font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($l->nama_perusahaan, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900 text-sm">{{ $l->nama_posisi }}</p>
                                    <p class="text-xs text-slate-500">{{ $l->nama_perusahaan }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs">{{ $l->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $l->created_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.lowongan.edit', $l->id) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-orange-500 inline-flex">
                                <svg class="icon w-4 h-4"><use href="#icon-pencil"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-xs text-slate-500">Belum ada data lowongan kerja.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection