@extends('layouts.admin')

@section('title', 'Kelola Favorit - Admin Info Loker Panas')
@section('page-title', 'Kelola Favorit')
@section('page-subtitle', 'Lihat siapa saja yang menyimpan lowongan ke dalam favorit')

@section('content')

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Lowongan</th>
                        <th class="px-6 py-4">Perusahaan</th>
                        <th class="px-6 py-4">Ditambahkan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($favorit as $f)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900">{{ $f->user->name ?? 'Pengguna dihapus' }}</p>
                            <p class="text-xs text-slate-500">{{ $f->user->email ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ $f->lowongan->nama_posisi ?? 'Lowongan dihapus' }}
                        </td>
                        <td class="px-6 py-4 text-slate-600">
                            {{ $f->lowongan->nama_perusahaan ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs">
                            {{ $f->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.favorit.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus favorit ini?')">
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
                        <td colspan="5" class="px-6 py-10 text-center text-xs text-slate-500">
                            Belum ada lowongan yang difavoritkan oleh pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($favorit->hasPages())
    <div class="mt-4">
        {{ $favorit->links() }}
    </div>
    @endif

@endsection