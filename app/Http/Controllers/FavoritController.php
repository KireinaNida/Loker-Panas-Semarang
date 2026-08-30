<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    /**
     * Tampilkan daftar lowongan favorit milik user
     */
    public function index()
    {
        $favoritList = Favorit::where('user_id', Auth::id())
            ->with('lowongan.kategori')
            ->latest()
            ->paginate(9);

        return view('favorit.index', compact('favoritList'));
    }

    /**
     * Tambahkan lowongan ke daftar favorit
     */
    public function store(Request $request)
    {
        $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id',
        ]);

        $existing = Favorit::where('user_id', Auth::id())
            ->where('lowongan_id', $request->lowongan_id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Lowongan dihapus dari favorit.');
        }

        Favorit::create([
            'user_id' => Auth::id(),
            'lowongan_id' => $request->lowongan_id,
        ]);

        return back()->with('success', 'Lowongan berhasil disimpan ke daftar favorit');
    }

    /**
     * Hapus lowongan dari daftar favorit (milik user sendiri)
     */
    public function destroy($id)
    {
        $favorit = Favorit::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $favorit->delete();

        return back()->with('success', 'Lowongan berhasil dihapus dari favorit.');
    }

    /**
     * [ADMIN] Tampilkan semua data favorit dari seluruh user
     */
    public function adminIndex()
    {
        $favorit = Favorit::with(['user', 'lowongan'])
            ->latest()
            ->paginate(15);

        return view('admin.favorit.index', compact('favorit'));
    }

    /**
     * [ADMIN] Hapus data favorit milik user manapun
     */
    public function adminDestroy(Favorit $favorit)
    {
        $favorit->delete();

        return redirect()->route('admin.favorit.index')->with('success', 'Favorit berhasil dihapus.');
    }
}