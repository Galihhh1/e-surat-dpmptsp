<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'perihal',
        'jenis_surat',
        'tanggal_surat',
        'file_surat',
        'status',
        'bidang_id',
        'catatan_disposisi',
    ];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function historiSurats(): HasMany
    {
        return $this->hasMany(HistoriSurat::class);
    }
}