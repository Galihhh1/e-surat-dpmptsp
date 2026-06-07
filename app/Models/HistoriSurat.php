<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_masuk_id',
        'user_id',
        'aktivitas',
        'keterangan',
    ];

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}