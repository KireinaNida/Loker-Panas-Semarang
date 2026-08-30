<?php

use App\Http\Controllers\Admin\LowonganController as AdminLowonganController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LowonganController::class, 'home'])->name('beranda');
Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.show');

Route::get('/home', function () {
    return view('welcome');
})->middleware(['auth'])->name('home');

// Dipertahankan biar route('dashboard') bawaan Breeze tetap ada, tapi diarahkan ke Beranda
Route::get('/dashboard', function () {
    return redirect()->route('beranda');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/favorit', [FavoritController::class, 'index'])->name('favorit.index');
    Route::post('/favorit', [FavoritController::class, 'store'])->name('favorit.store');
    Route::delete('/favorit/{id}', [FavoritController::class, 'destroy'])->name('favorit.destroy');

    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/lamar/{id}/email', [LamaranController::class, 'lamarEmail'])->name('lamaran.email');
    Route::get('/lamar/{id}/wa', [LamaranController::class, 'lamarWa'])->name('lamaran.wa');
    Route::get('/lamar/{id}/cepat', [LamaranController::class, 'lamarCepat'])->name('lamaran.cepat');
});

// Grup khusus admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::resource('lowongan', AdminLowonganController::class);

    Route::get('/favorit', [FavoritController::class, 'adminIndex'])->name('favorit.index');
    Route::delete('/favorit/{favorit}', [FavoritController::class, 'adminDestroy'])->name('favorit.destroy');

    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::put('/review/{review}/balas', [ReviewController::class, 'balas'])->name('review.balas');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

require __DIR__.'/auth.php';