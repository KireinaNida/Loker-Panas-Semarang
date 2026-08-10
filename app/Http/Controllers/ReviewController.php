<?php

namespace App\Http\Controllers;

use App\Models\Review;
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
}