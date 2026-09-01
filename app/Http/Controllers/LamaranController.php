<?php

namespace App\Http\Controllers;

use App\Models\DokumenLamaran;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LamaranController extends Controller
{
    /**
     * Tampilkan formulir pelamaran kerja (In-System Application)
     */
    public function create(int $id): View|RedirectResponse
    {
        $lowongan = Lowongan::with('kategori')->findOrFail($id);

        // Cek apakah user sudah pernah melamar lowongan ini sebelumnya
        $existingLamaran = Lamaran::where('user_id', Auth::id())
            ->where('lowongan_id', $lowongan->id)
            ->first();

        if ($existingLamaran) {
            return redirect()->route('lamaran.riwayat')
                ->with('error', 'Anda sudah pernah mengajukan lamaran untuk posisi ' . $lowongan->nama_posisi . ' di ' . $lowongan->nama_perusahaan . '. Status lamaran Anda: ' . $existingLamaran->status . '.');
        }

        return view('lamaran.create', [
            'lowongan' => $lowongan,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Proses pengiriman berkas dan pendaftaran lamaran
     */
    public function store(Request $request, int $id): RedirectResponse
    {
        $lowongan = Lowongan::findOrFail($id);
        $user = Auth::user();

        // Validasi Duplikasi
        $existingLamaran = Lamaran::where('user_id', $user->id)
            ->where('lowongan_id', $lowongan->id)
            ->exists();

        if ($existingLamaran) {
            return redirect()->route('lamaran.riwayat')
                ->with('error', 'Anda sudah mengajukan lamaran untuk lowongan ini.');
        }

        // Validasi 3 Berkas Wajib + KTP & Berkas Tambahan (Opsional)
        $request->validate([
            'dokumen_cv' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'dokumen_ijazah' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'dokumen_foto' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:3072'],
            'dokumen_ktp' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:3072'],
            'catatan_pelamar' => ['nullable', 'string', 'max:1000'],
            'dokumen_tambahan.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,zip', 'max:5120'],
            'nama_dokumen_tambahan.*' => ['nullable', 'string', 'max:150'],
        ], [
            'dokumen_cv.required' => 'Curriculum Vitae (CV) wajib diunggah dalam format PDF.',
            'dokumen_cv.mimes' => 'Curriculum Vitae (CV) harus bertipe PDF.',
            'dokumen_cv.max' => 'Ukuran file CV maksimal 5 MB.',

            'dokumen_ijazah.required' => 'Ijazah Terakhir wajib diunggah (PDF / Foto).',
            'dokumen_ijazah.mimes' => 'Format Ijazah harus PDF, JPG, JPEG, atau PNG.',
            'dokumen_ijazah.max' => 'Ukuran file Ijazah maksimal 5 MB.',

            'dokumen_foto.required' => 'Pas Foto Formal wajib diunggah.',
            'dokumen_foto.mimes' => 'Format Pas Foto harus JPG, JPEG, atau PNG.',
            'dokumen_foto.max' => 'Ukuran Pas Foto maksimal 3 MB.',

            'dokumen_ktp.mimes' => 'Format KTP harus PDF, JPG, JPEG, atau PNG.',
            'dokumen_ktp.max' => 'Ukuran file KTP maksimal 3 MB.',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan Entitas Lamaran
            $lamaran = Lamaran::create([
                'user_id' => $user->id,
                'lowongan_id' => $lowongan->id,
                'status' => Lamaran::STATUS_MENUNGGU,
                'catatan_pelamar' => $request->catatan_pelamar,
            ]);

            $uploadPath = 'dokumen_lamaran/' . $user->id . '/' . $lamaran->id;

            // 2. Simpan Berkas Wajib (CV, Ijazah, Foto)
            $mandatoryDocs = [
                [
                    'file' => $request->file('dokumen_cv'),
                    'jenis' => 'cv',
                    'nama' => 'Curriculum Vitae (CV)',
                ],
                [
                    'file' => $request->file('dokumen_ijazah'),
                    'jenis' => 'ijazah',
                    'nama' => 'Ijazah Terakhir',
                ],
                [
                    'file' => $request->file('dokumen_foto'),
                    'jenis' => 'foto_formal',
                    'nama' => 'Pas Foto Formal',
                ],
            ];

            foreach ($mandatoryDocs as $doc) {
                if ($doc['file']) {
                    $file = $doc['file'];
                    $path = $file->store($uploadPath, 'public');

                    DokumenLamaran::create([
                        'lamaran_id' => $lamaran->id,
                        'jenis_dokumen' => $doc['jenis'],
                        'nama_dokumen' => $doc['nama'],
                        'nama_file_asli' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                    ]);
                }
            }

            // 2.1 Simpan KTP jika diunggah (Opsional)
            if ($request->hasFile('dokumen_ktp')) {
                $ktpFile = $request->file('dokumen_ktp');
                $path = $ktpFile->store($uploadPath, 'public');

                DokumenLamaran::create([
                    'lamaran_id' => $lamaran->id,
                    'jenis_dokumen' => 'ktp',
                    'nama_dokumen' => 'Kartu Tanda Penduduk (KTP)',
                    'nama_file_asli' => $ktpFile->getClientOriginalName(),
                    'file_path' => $path,
                    'file_size' => $ktpFile->getSize(),
                    'mime_type' => $ktpFile->getMimeType(),
                ]);
            }

            // 3. Simpan Berkas Opsional (jika ada)
            if ($request->hasFile('dokumen_tambahan')) {
                $tambahanFiles = $request->file('dokumen_tambahan');
                $tambahanNames = $request->input('nama_dokumen_tambahan', []);

                foreach ($tambahanFiles as $index => $file) {
                    if ($file && $file->isValid()) {
                        $customTitle = !empty($tambahanNames[$index]) ? trim($tambahanNames[$index]) : 'Dokumen Pendukung ' . ($index + 1);
                        $path = $file->store($uploadPath, 'public');

                        DokumenLamaran::create([
                            'lamaran_id' => $lamaran->id,
                            'jenis_dokumen' => 'tambahan',
                            'nama_dokumen' => $customTitle,
                            'nama_file_asli' => $file->getClientOriginalName(),
                            'file_path' => $path,
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getMimeType(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('lamaran.riwayat')
                ->with('success', 'Lamaran untuk posisi ' . $lowongan->nama_posisi . ' di ' . $lowongan->nama_perusahaan . ' berhasil dikirim! Tim Info Loker Panas akan meninjau berkas Anda.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memproses lamaran Anda: ' . $e->getMessage());
        }
    }

    /**
     * Halaman Riwayat & Pelacakan Lamaran Kerja Pelamar
     */
    public function riwayat(): View
    {
        $lamarans = Lamaran::with(['lowongan.kategori', 'dokumen'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('lamaran.riwayat', [
            'lamarans' => $lamarans,
        ]);
    }
}