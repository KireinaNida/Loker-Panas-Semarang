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
        'user_id',
        'lowongan_id',
        'rating',
        'komentar',
        'balasan',
        'dibalas_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'dibalas_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function sudahDibalas(): bool
    {
        return ! is_null($this->balasan);
    }
}