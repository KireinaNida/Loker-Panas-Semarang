<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('lowongan')->latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id,
        ], [
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->lowongan()->exists()) {
            return redirect()->route('admin.kategori.index')->with('error', 'Kategori tidak bisa dihapus karena masih dipakai oleh lowongan.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}