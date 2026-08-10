<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'kategori_id',
        'nama_posisi',
        'nama_perusahaan',
        'alamat_perusahaan',
        'website_perusahaan',
        'lokasi',
        'tingkat_pendidikan',
        'tipe_pekerjaan',
        'gaji',
        'deskripsi',
        'persyaratan',
        'benefit',
        'batas_lamar',
        'link_sumber',
        'status',
        'email_perusahaan',
        'wa_perusahaan',
    ];

    protected $casts = [
        'batas_lamar' => 'date',
    ];

    /**
     * Relasi ke Kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke Review
     */
    public function review(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke Favorit
     */
    public function favorit(): HasMany
    {
        return $this->hasMany(Favorit::class);
    }

    /**
     * Scope khusus untuk memfilter lowongan yang valid tampil di publik
     * Lowongan tampil jika status = 'aktif' DAN batas_lamar >= hari ini
     */
    public function scopePublik(Builder $query): Builder
    {
        return $query->where('status', 'aktif')
                     ->where(function ($q) {
                         $q->whereNull('batas_lamar')
                           ->orWhere('batas_lamar', '>=', now()->startOfDay());
                     });
    }
}
