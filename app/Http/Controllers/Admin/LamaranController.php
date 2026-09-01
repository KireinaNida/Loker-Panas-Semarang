<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForwardLamaranMail;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LamaranController extends Controller
{
    /**
     * Daftar seluruh lamaran masuk
     */
    public function index(Request $request): View
    {
        $query = Lamaran::with(['user', 'lowongan.kategori', 'dokumen']);

        // Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter Lowongan
        if ($request->filled('lowongan_id')) {
            $query->where('lowongan_id', $request->lowongan_id);
        }

        // Search Pelamar (Nama atau Email)
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nama_panggilan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        $lamarans = $query->latest()->paginate(10)->withQueryString();

        // Hitung Counter Status
        $countTotal = Lamaran::count();
        $countMenunggu = Lamaran::where('status', Lamaran::STATUS_MENUNGGU)->count();
        $countDiteruskan = Lamaran::where('status', Lamaran::STATUS_DITERUSKAN)->count();
        $countDitolak = Lamaran::where('status', Lamaran::STATUS_DITOLAK)->count();

        $lowongans = Lowongan::orderBy('nama_posisi')->get();

        return view('admin.lamaran.index', compact(
            'lamarans',
            'countTotal',
            'countMenunggu',
            'countDiteruskan',
            'countDitolak',
            'lowongans'
        ));
    }

    /**
     * Tampilkan detail lamaran & berkas kandidat
     */
    public function show(int $id): View
    {
        $lamaran = Lamaran::with(['user', 'lowongan.kategori', 'dokumen'])->findOrFail($id);

        return view('admin.lamaran.show', compact('lamaran'));
    }

    /**
     * Teruskan berkas lamaran ke email perusahaan (Approve)
     */
    public function forward(Request $request, int $id): RedirectResponse
    {
        $lamaran = Lamaran::with(['user', 'lowongan', 'dokumen'])->findOrFail($id);

        $request->validate([
            'email_tujuan' => ['nullable', 'email'],
        ]);

        $targetEmail = $request->email_tujuan ?: $lamaran->lowongan->email_perusahaan;

        if (!$targetEmail) {
            return back()->with('error', 'Alamat email perusahaan belum diatur. Harap masukkan alamat email tujuan pengiriman.');
        }

        // Kirim email dengan lampiran
        $mailSent = false;
        try {
            Mail::to($targetEmail)->send(new ForwardLamaranMail($lamaran));
            $mailSent = true;
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email forward lamaran: ' . $e->getMessage(), [
                'lamaran_id' => $lamaran->id,
                'target_email' => $targetEmail,
            ]);
        }

        // Update status lamaran
        $lamaran->update([
            'status' => Lamaran::STATUS_DITERUSKAN,
            'diteruskan_at' => now(),
        ]);

        $msg = 'Lamaran kandidat ' . $lamaran->user->name . ' berhasil disetujui & status diubah menjadi "Diteruskan".';
        if ($mailSent) {
            $msg .= ' Email lampiran berkas berhasil dikirim ke ' . $targetEmail . '.';
        } else {
            $msg .= ' (Pemberitahuan: Server SMTP pengirim sedang tidak aktif di lokal, status lamaran tetap berhasil diperbarui).';
        }

        return back()->with('success', $msg);
    }

    /**
     * Tolak berkas lamaran dengan catatan alasan (Reject)
     */
    public function reject(Request $request, int $id): RedirectResponse
    {
        $lamaran = Lamaran::with('user')->findOrFail($id);

        $request->validate([
            'catatan_admin' => ['required', 'string', 'max:1000'],
        ], [
            'catatan_admin.required' => 'Alasan penolakan berkas wajib diisi untuk diinformasikan ke pelamar.',
        ]);

        $lamaran->update([
            'status' => Lamaran::STATUS_DITOLAK,
            'catatan_admin' => $request->catatan_admin,
            'ditolak_at' => now(),
        ]);

        return back()->with('success', 'Lamaran kandidat ' . $lamaran->user->name . ' telah ditolak dengan catatan yang dilampirkan.');
    }
}
