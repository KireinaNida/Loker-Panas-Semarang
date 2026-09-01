<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class DokumenLamaran extends Model
{
    use HasFactory;

    protected $table = 'dokumen_lamaran';

    protected $fillable = [
        'lamaran_id',
        'jenis_dokumen',
        'nama_dokumen',
        'nama_file_asli',
        'file_path',
        'file_size',
        'mime_type',
    ];

    /**
     * Relasi ke Lamaran
     */
    public function lamaran(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class);
    }

    /**
     * Dapatkan URL publik file
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Cek apakah format PDF
     */
    public function isPdf(): bool
    {
        return str_contains(strtolower($this->mime_type ?? ''), 'pdf') || str_ends_with(strtolower($this->file_path), '.pdf');
    }

    /**
     * Cek apakah format Gambar
     */
    public function isImage(): bool
    {
        return str_contains(strtolower($this->mime_type ?? ''), 'image') || preg_match('/\.(jpg|jpeg|png|webp)$/i', $this->file_path);
    }

    /**
     * Format ukuran berkas (KB / MB)
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }
}
