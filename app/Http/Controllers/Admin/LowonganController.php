<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = Lowongan::with('kategori')->latest()->get();
        return view('admin.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoris = $kategori;
        return view('admin.lowongan.create', compact('kategori', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_posisi' => 'required|string|max:150',
            'nama_perusahaan' => 'required|string|max:150',
            'alamat_perusahaan' => 'nullable|string|max:200',
            'email_perusahaan' => 'nullable|email|max:150',
            'wa_perusahaan' => 'nullable|regex:/^[0-9+]{9,15}$/',
            'website_perusahaan' => 'nullable|string|max:200',
            'lokasi' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategori,id',
            'tingkat_pendidikan' => 'required|string|max:50',
            'tipe_pekerjaan' => 'required|string|max:50',
            'gaji' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'benefit' => 'nullable|string',
            'batas_lamar' => 'nullable|date',
            'link_sumber' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Lowongan::create($validated);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function edit(Lowongan $lowongan)
    {
        $kategori = Kategori::all();
        $kategoris = $kategori;
        return view('admin.lowongan.edit', compact('lowongan', 'kategori', 'kategoris'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $validated = $request->validate([
            'nama_posisi' => 'required|string|max:150',
            'nama_perusahaan' => 'required|string|max:150',
            'alamat_perusahaan' => 'nullable|string|max:200',
            'email_perusahaan' => 'nullable|email|max:150',
            'wa_perusahaan' => 'nullable|regex:/^[0-9+]{9,15}$/',
            'website_perusahaan' => 'nullable|string|max:200',
            'lokasi' => 'required|string|max:150',
            'kategori_id' => 'required|exists:kategori,id',
            'tingkat_pendidikan' => 'required|string|max:50',
            'tipe_pekerjaan' => 'required|string|max:50',
            'gaji' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'benefit' => 'nullable|string',
            'batas_lamar' => 'nullable|date',
            'link_sumber' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $lowongan->update($validated);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }
}