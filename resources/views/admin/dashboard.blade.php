@extends('layouts.admin')

@section('title', 'Dashboard Admin - Info Loker Panas')
@section('page-title', 'Dashboard Ringkasan')
@section('page-subtitle', 'Ringkasan aktivitas, lowongan kerja, dan lamaran masuk')

@section('content')

    <div class="p-6 space-y-6">

        <!-- STATS -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-slate-500 font-bold">Total Lowongan</span>
                    <div class="w-9 h-9 rounded-lg bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-500">
                        <svg class="icon w-4 h-4"><use href="#icon-briefcase"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-extrabold text-slate-900">{{ number_format($totalLowongan) }}</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-slate-500 font-bold">Lowongan Aktif</span>
                    <div class="w-9 h-9 rounded-lg bg-orange-50 border border-orange-200 flex items-center justify-center text-orange-500">
                        <svg class="icon w-4 h-4"><use href="#icon-flame"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-extrabold text-orange-500">{{ number_format($lowonganAktif) }}</p>
            </div>

            <a href="{{ route('admin.lamaran.index') }}" class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-amber-400 transition">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-amber-600 font-bold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Menunggu Review
                    </span>
                    <div class="w-9 h-9 rounded-lg bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600">
                        <svg class="icon w-4 h-4"><use href="#icon-folder"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-extrabold text-amber-600">{{ number_format($lamaranMenunggu) }}</p>
            </a>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-slate-500 font-bold">Total Lamaran Masuk</span>
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600">
                        <svg class="icon w-4 h-4"><use href="#icon-check"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-extrabold text-slate-900">{{ number_format($totalLamaran) }}</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-slate-500 font-bold">Ulasan Pelamar</span>
                    <div class="w-9 h-9 rounded-lg bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-500">
                        <svg class="icon w-4 h-4"><use href="#icon-star"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-extrabold text-slate-900">{{ number_format($totalReview) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- TABEL LAMARAN TERBARU -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="flex justify-between items-center p-5 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="font-extrabold text-sm text-slate-900">Lamaran Masuk Terbaru</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Berkas pendaftaran yang baru dikirim oleh pelamar</p>
                    </div>
                    <a href="{{ route('admin.lamaran.index') }}" class="text-xs font-bold text-orange-500 hover:underline">Kelola &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 text-[10px] font-extrabold uppercase">
                            <tr>
                                <th class="px-5 py-3">Pelamar</th>
                                <th class="px-5 py-3">Posisi</th>
                                <th class="px-5 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            @forelse($lamaranTerbaru as $lam)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-5 py-3.5">
                                        <p class="font-bold text-slate-900">{{ $lam->user->name ?? 'User Terhapus' }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $lam->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <p class="font-semibold text-slate-800">{{ $lam->lowongan->nama_posisi ?? '-' }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $lam->lowongan->nama_perusahaan ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        @if($lam->status === 'Menunggu Review')
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                                Review
                                            </span>
                                        @elseif($lam->status === 'Diteruskan')
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Diteruskan
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-50 text-rose-700 border border-rose-200">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-slate-400">Belum ada lamaran masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABEL LOWONGAN TERBARU -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="flex justify-between items-center p-5 pb-4 border-b border-slate-100">
                    <div>
                        <h3 class="font-extrabold text-sm text-slate-900">Lowongan Kerja Terbaru</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Postingan loker yang baru saja ditambahkan</p>
                    </div>
                    <a href="{{ route('admin.lowongan.index') }}" class="text-xs font-bold text-orange-500 hover:underline">Kelola &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 text-[10px] font-extrabold uppercase">
                            <tr>
                                <th class="px-5 py-3">Posisi & Perusahaan</th>
                                <th class="px-5 py-3">Kategori</th>
                                <th class="px-5 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            @forelse($lowonganTerbaru as $l)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-5 py-3.5">
                                        <p class="font-bold text-slate-900">{{ $l->nama_posisi }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $l->nama_perusahaan }}</p>
                                    </td>
                                    <td class="px-5 py-3.5 text-slate-600">{{ $l->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-5 py-3.5 text-right">
                                        <a href="{{ route('admin.lowongan.edit', $l->id) }}" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-orange-500 inline-flex">
                                            <svg class="icon w-4 h-4"><use href="#icon-pencil"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-slate-400">Belum ada data lowongan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection