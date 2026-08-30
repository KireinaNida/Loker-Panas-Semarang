@extends('layouts.admin')

@section('title', 'Kelola Review - Admin Info Loker Panas')
@section('page-title', 'Kelola Review & Rating')
@section('page-subtitle', 'Lihat, tanggapi, atau hapus review dari pengguna')

@section('content')

    <div x-data="{ showModal: false, replyId: null, replyKomentar: '', replyExisting: '' }">

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Lowongan</th>
                            <th class="px-6 py-4">Rating</th>
                            <th class="px-6 py-4">Komentar</th>
                            <th class="px-6 py-4">Balasan Admin</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($review as $r)
                        <tr class="hover:bg-slate-50 transition-colors align-top">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">{{ $r->user->name ?? 'Pengguna dihapus' }}</p>
                                <p class="text-xs text-slate-500">{{ $r->created_at->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-700 font-medium">
                                {{ $r->lowongan->nama_posisi ?? 'Lowongan dihapus' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-0.5 text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="icon w-3.5 h-3.5 {{ $i <= $r->rating ? 'icon-fill' : '' }}"><use href="#icon-star"/></svg>
                                    @endfor
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-700 max-w-xs">
                                {{ $r->komentar }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs">
                                @if($r->sudahDibalas())
                                    <span class="block text-xs font-bold text-emerald-700 mb-1">Sudah dibalas</span>
                                    {{ $r->balasan }}
                                @else
                                    <span class="text-xs text-slate-400 italic">Belum dibalas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-y-2">
                                <button
                                    @click="showModal = true; replyId = {{ $r->id }}; replyKomentar = '{{ addslashes($r->komentar) }}'; replyExisting = '{{ addslashes($r->balasan ?? '') }}'"
                                    class="block w-full px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:border-orange-300 transition-colors">
                                    Balas
                                </button>
                                <form action="{{ route('admin.review.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full px-3 py-1.5 rounded-xl border border-rose-200 bg-rose-50 text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-xs text-slate-500">
                                Belum ada review dari pengguna.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($review->hasPages())
        <div class="mt-4">
            {{ $review->links() }}
        </div>
        @endif

        <!-- Modal Balas Review -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-lg p-6 sm:p-8 z-10">
                <h3 class="font-bold text-xl text-slate-900 mb-2">Balas Review</h3>
                <p class="text-xs text-slate-500 mb-4 bg-slate-50 border border-slate-200 rounded-xl p-3" x-text="replyKomentar"></p>

                <form :action="'/admin/review/' + replyId + '/balas'" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Balasan Anda</label>
                        <textarea name="balasan" x-model="replyExisting" required rows="4"
                                  class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-slate-50 focus:bg-white focus:border-orange-400 outline-none"
                                  placeholder="Tulis tanggapan untuk review ini..."></textarea>
                    </div>

                    <div class="flex gap-2 justify-end pt-2">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-orange-400 text-white text-xs font-bold hover:bg-orange-500 transition-colors shadow-sm">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection