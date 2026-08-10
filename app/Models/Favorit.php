<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorit extends Model
{
    use HasFactory;

    protected $table = 'favorit';

    protected $fillable = [
        'user_id',
        'lowongan_id',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Lowongan
     */
    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Lowongan::class);
    }
}
