<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tujuan_surat',
        'perihal',
        'jenis_surat',
        'tanggal_surat',
        'file_surat',
        'status',
        'user_id',
        'isi_surat',
        'approved_by',
        'approved_at',
        'catatan_approval',
        'catatan_penolakan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}