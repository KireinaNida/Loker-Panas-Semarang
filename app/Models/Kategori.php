<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    /**
     * Relasi ke Lowongan
     */
    public function lowongan(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }
}
