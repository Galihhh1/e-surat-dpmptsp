<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class ValidasiSuratController extends Controller
{
    public function index(Request $request)
    {
        $nomorSurat = $request->query('nomor_surat');

        $suratMasuk = null;
        $suratKeluar = null;

        if ($nomorSurat) {
            $suratMasuk = SuratMasuk::with('bidang')
                ->where('nomor_surat', $nomorSurat)
                ->first();

            $suratKeluar = SuratKeluar::with('user')
                ->where('nomor_surat', $nomorSurat)
                ->first();
        }

        return view('validasi-surat.index', compact(
            'nomorSurat',
            'suratMasuk',
            'suratKeluar'
        ));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string',
        ]);

        $nomorSurat = $request->nomor_surat;

        $suratMasuk = SuratMasuk::with('bidang')
            ->where('nomor_surat', $nomorSurat)
            ->first();

        $suratKeluar = SuratKeluar::with('user')
            ->where('nomor_surat', $nomorSurat)
            ->first();

        return view('validasi-surat.index', compact(
            'nomorSurat',
            'suratMasuk',
            'suratKeluar'
        ));
    }
}