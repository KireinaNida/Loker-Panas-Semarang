<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use App\Models\Kategori;
use App\Models\Lowongan;
use App\Models\LogLamaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLowongan = Lowongan::count();
        $totalKategori = Kategori::count();
        $lowonganAktif = Lowongan::publik()->count();
        $totalKlikLamar = LogLamaran::count();
        $totalFavorit = Favorit::count();

        $lowonganTerbaru = Lowongan::with('kategori')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLowongan', 'totalKategori', 'lowonganAktif', 'totalKlikLamar',
            'totalFavorit', 'lowonganTerbaru'
        ));
    }
}