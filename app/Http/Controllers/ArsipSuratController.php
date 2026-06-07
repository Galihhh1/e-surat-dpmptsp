<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $bidangs = Bidang::latest()->get();

        $jenis = $request->get('jenis', 'semua');

        $suratMasuks = collect();
        $suratKeluars = collect();

        if ($jenis === 'semua' || $jenis === 'surat_masuk') {
            $queryMasuk = SuratMasuk::with('bidang')
                ->where('status', 'arsip');

            if ($user->role === 'user_bidang') {
                $queryMasuk->where('bidang_id', $user->bidang_id);
            }

            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $queryMasuk->whereBetween('tanggal_surat', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir,
                ]);
            }

            if ($request->filled('bidang_id') && $user->role === 'admin_tu') {
                $queryMasuk->where('bidang_id', $request->bidang_id);
            }

            if ($request->filled('search')) {
                $search = $request->search;

                $queryMasuk->where(function ($q) use ($search) {
                    $q->where('nomor_surat', 'like', '%' . $search . '%')
                        ->orWhere('pengirim', 'like', '%' . $search . '%')
                        ->orWhere('perihal', 'like', '%' . $search . '%')
                        ->orWhere('jenis_surat', 'like', '%' . $search . '%');
                });
            }

            $suratMasuks = $queryMasuk->latest()->get();
        }

        if ($jenis === 'semua' || $jenis === 'surat_keluar') {
            $queryKeluar = SuratKeluar::with('user')
                ->where('status', 'arsip');

            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $queryKeluar->whereBetween('tanggal_surat', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir,
                ]);
            }

            if ($request->filled('search')) {
                $search = $request->search;

                $queryKeluar->where(function ($q) use ($search) {
                    $q->where('nomor_surat', 'like', '%' . $search . '%')
                        ->orWhere('tujuan_surat', 'like', '%' . $search . '%')
                        ->orWhere('perihal', 'like', '%' . $search . '%')
                        ->orWhere('jenis_surat', 'like', '%' . $search . '%');
                });
            }

            $suratKeluars = $queryKeluar->latest()->get();
        }

        return view('arsip-surat.index', compact(
            'suratMasuks',
            'suratKeluars',
            'bidangs',
            'jenis'
        ));
    }

    public function restoreSuratMasuk(SuratMasuk $suratMasuk)
    {
        $user = Auth::user();

        if ($user->role === 'user_bidang' && $suratMasuk->bidang_id !== $user->bidang_id) {
            abort(403);
        }

        if ($suratMasuk->status !== 'arsip') {
            return redirect()
                ->route('arsip-surat.index')
                ->with('success', 'Surat masuk ini bukan data arsip.');
        }

        $suratMasuk->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('arsip-surat.index')
            ->with('success', 'Arsip surat masuk berhasil dikembalikan.');
    }

    public function restoreSuratKeluar(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        if ($suratKeluar->status !== 'arsip') {
            return redirect()
                ->route('arsip-surat.index')
                ->with('success', 'Surat keluar ini bukan data arsip.');
        }

        $suratKeluar->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('arsip-surat.index')
            ->with('success', 'Arsip surat keluar berhasil dikembalikan.');
    }
}