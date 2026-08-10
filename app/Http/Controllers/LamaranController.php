<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\LogLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    public function lamarEmail($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if (!$lowongan->email_perusahaan) {
            return back()->with('error', 'Kontak email untuk lowongan ini belum tersedia.');
        }

        LogLamaran::create([
            'user_id' => Auth::id(),
            'lowongan_id' => $lowongan->id,
            'metode' => 'email',
        ]);

        $subject = rawurlencode('Lamaran Kerja - ' . $lowongan->nama_posisi);
        return redirect('mailto:' . $lowongan->email_perusahaan . '?subject=' . $subject);
    }

    public function lamarWa($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if (!$lowongan->wa_perusahaan) {
            return back()->with('error', 'Kontak WhatsApp untuk lowongan ini belum tersedia.');
        }

        LogLamaran::create([
            'user_id' => Auth::id(),
            'lowongan_id' => $lowongan->id,
            'metode' => 'wa',
        ]);

        $pesan = rawurlencode('Halo, saya tertarik melamar posisi ' . $lowongan->nama_posisi . ' di ' . $lowongan->nama_perusahaan . ' yang saya lihat di InfoLoker Panas.');
        $nomor = preg_replace('/[^0-9]/', '', $lowongan->wa_perusahaan);

        return redirect('https://wa.me/' . $nomor . '?text=' . $pesan);
    }

    public function lamarCepat($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        if ($lowongan->wa_perusahaan) {
            return $this->lamarWa($id);
        }

        if ($lowongan->email_perusahaan) {
            return $this->lamarEmail($id);
        }

        return back()->with('error', 'Kontak untuk melamar lowongan ini belum tersedia.');
    }
}