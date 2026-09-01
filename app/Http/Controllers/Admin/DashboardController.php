<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use App\Models\Kategori;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLowongan = Lowongan::count();
        $totalKategori = Kategori::count();
        $lowonganAktif = Lowongan::publik()->count();
        $totalLamaran = Lamaran::count();
        $lamaranMenunggu = Lamaran::where('status', Lamaran::STATUS_MENUNGGU)->count();
        $totalFavorit = Favorit::count();
        $totalReview = Review::count();

        $lowonganTerbaru = Lowongan::with('kategori')->latest()->take(5)->get();
        $lamaranTerbaru = Lamaran::with(['user', 'lowongan'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLowongan', 'totalKategori', 'lowonganAktif', 'totalLamaran',
            'lamaranMenunggu', 'totalFavorit', 'totalReview', 'lowonganTerbaru', 'lamaranTerbaru'
        ));
    }
}