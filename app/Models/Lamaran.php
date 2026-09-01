<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran';

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'status',
        'catatan_admin',
        'catatan_pelamar',
        'diteruskan_at',
        'ditolak_at',
    ];

    protected $casts = [
        'diteruskan_at' => 'datetime',
        'ditolak_at' => 'datetime',
    ];

    public const STATUS_MENUNGGU = 'Menunggu Review';
    public const STATUS_DITERUSKAN = 'Diteruskan';
    public const STATUS_DITOLAK = 'Ditolak';

    /**
     * Relasi ke Pelamar (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Lowongan Kerja
     */
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    /**
     * Relasi ke Berkas Dokumen Lamaran
     */
    public function dokumen(): HasMany
    {
        return $this->hasMany(DokumenLamaran::class);
    }

    /**
     * Helper Status
     */
    public function isMenunggu(): bool
    {
        return $this->status === self::STATUS_MENUNGGU;
    }

    public function isDiteruskan(): bool
    {
        return $this->status === self::STATUS_DITERUSKAN;
    }

    public function isDitolak(): bool
    {
        return $this->status === self::STATUS_DITOLAK;
    }
}
