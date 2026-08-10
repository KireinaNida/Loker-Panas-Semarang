<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'lowongan_id',
        'user_id',
        'rating',
        'komentar',
    ];

    /**
     * Relasi ke Lowongan
     */
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
