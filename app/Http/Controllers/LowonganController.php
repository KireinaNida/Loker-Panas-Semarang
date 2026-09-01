<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use App\Models\Kategori;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    /**
     * Halaman beranda utama
     */
    public function home()
    {
        $kategoriList = Kategori::withCount('lowongan')->get();
        $lowonganTerbaru = Lowongan::publik()
            ->with('kategori')
            ->latest()
            ->take(6)
            ->get();

        $totalLowongan = Lowongan::publik()->count();
        $totalPerusahaan = Lowongan::publik()->distinct('nama_perusahaan')->count('nama_perusahaan');

        return view('index', compact('kategoriList', 'lowonganTerbaru', 'totalLowongan', 'totalPerusahaan'));
    }

    /**
     * Halaman daftar lowongan kerja publik + Filter & Search
     */
    public function index(Request $request)
    {
        $query = Lowongan::publik()->with('kategori');

        // Search Keyword (Posisi / Perusahaan / Deskripsi)
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_posisi', 'like', "%{$keyword}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter Lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        // Filter Tingkat Pendidikan
        if ($request->filled('tingkat_pendidikan')) {
            $query->where('tingkat_pendidikan', $request->tingkat_pendidikan);
        }

        // Filter Tipe Pekerjaan
        if ($request->filled('tipe_pekerjaan')) {
            $query->where('tipe_pekerjaan', $request->tipe_pekerjaan);
        }

        $lowongan = $query->latest()->paginate(9)->withQueryString();
        $kategoriList = Kategori::all();

        return view('lowongan.index', compact('lowongan', 'kategoriList'));
    }

    /**
     * Halaman Detail Lowongan
     */
    public function show($id)
    {
        $lowongan = Lowongan::with(['kategori', 'review.user'])->findOrFail($id);

        $avgRating = $lowongan->review->avg('rating') ?: 0;
        $totalReview = $lowongan->review->count();

        $isFavorited = false;
        $existingLamaran = null;
        if (Auth::check()) {
            $isFavorited = Favorit::where('user_id', Auth::id())
                ->where('lowongan_id', $lowongan->id)
                ->exists();
            $existingLamaran = \App\Models\Lamaran::where('user_id', Auth::id())
                ->where('lowongan_id', $lowongan->id)
                ->first();
        }

        $lowonganTerkait = Lowongan::publik()
            ->where('kategori_id', $lowongan->kategori_id)
            ->where('id', '!=', $lowongan->id)
            ->take(3)
            ->get();

        return view('lowongan.show', compact('lowongan', 'avgRating', 'totalReview', 'isFavorited', 'existingLamaran', 'lowonganTerkait'));
    }
}
