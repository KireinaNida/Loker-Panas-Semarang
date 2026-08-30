<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Simpan / Update Review User pada suatu lowongan
     */
    public function store(Request $request)
    {
        $request->validate([
            'lowongan_id' => 'required|exists:lowongan,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => [
                $request->rating <= 2 ? 'required' : 'nullable',
                'string',
                'min:5',
                'max:1000',
            ],
        ], [
            'komentar.required' => 'Mohon jelaskan alasan rating rendah kamu, biar bisa jadi masukan yang membangun.',
        ]);

        Review::updateOrCreate(
            [
                'lowongan_id' => $request->lowongan_id,
                'user_id' => Auth::id(),
            ],
            [
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]
        );

        return back()->with('success', 'Ulasan dan rating Anda berhasil disimpan.');
    }

    /**
     * [ADMIN] Tampilkan daftar semua review
     */
    public function index()
    {
        $review = Review::with(['user', 'lowongan'])
            ->latest()
            ->paginate(15);

        return view('admin.review.index', compact('review'));
    }

    /**
     * [ADMIN] Kirim balasan admin untuk sebuah review
     */
    public function balas(Request $request, Review $review): RedirectResponse
    {
        $request->validate([
            'balasan' => 'required|string|max:1000',
        ]);

        $review->update([
            'balasan' => $request->balasan,
            'dibalas_at' => now(),
        ]);

        return redirect()->route('admin.review.index')->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * [ADMIN] Hapus review
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('admin.review.index')->with('success', 'Review berhasil dihapus.');
    }
}