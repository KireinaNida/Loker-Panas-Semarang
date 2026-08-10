<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLamaran extends Model
{
    protected $table = 'log_lamaran';

    protected $fillable = ['user_id', 'lowongan_id', 'metode'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}