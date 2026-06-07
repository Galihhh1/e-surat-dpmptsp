<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin_tu') {

            $totalSuratMasuk = SuratMasuk::count();

            $suratMasukBelumDiproses = SuratMasuk::where('status', 'didisposisikan')->count();

            $suratMasukDiproses = SuratMasuk::where('status', 'diproses')->count();

            $suratMasukSelesai = SuratMasuk::where('status', 'selesai')->count();

            $totalSuratKeluar = SuratKeluar::count();

            $suratKeluarDraft = SuratKeluar::where('status', 'draft')->count();

            $suratKeluarDikirim = SuratKeluar::where('status', 'dikirim')->count();

            $suratKeluarSelesai = SuratKeluar::where('status', 'selesai')->count();

            $suratKeluarPersetujuan = SuratKeluar::where('status', 'menunggu_persetujuan')->count();

            $totalBidang = Bidang::count();

            $totalUser = User::count();

            $suratMasukPerBulan = [];
            $suratKeluarPerBulan = [];

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $suratMasukPerBulan[] = SuratMasuk::whereYear('tanggal_surat', now()->year)
                    ->whereMonth('tanggal_surat', $bulan)
                    ->count();

                $suratKeluarPerBulan[] = SuratKeluar::whereYear('tanggal_surat', now()->year)
                    ->whereMonth('tanggal_surat', $bulan)
                    ->count();
            }

        } else {

            $totalSuratMasuk = SuratMasuk::where('bidang_id', $user->bidang_id)->count();

            $suratMasukBelumDiproses = SuratMasuk::where('bidang_id', $user->bidang_id)
                ->where('status', 'didisposisikan')
                ->count();

            $suratMasukDiproses = SuratMasuk::where('bidang_id', $user->bidang_id)
                ->where('status', 'diproses')
                ->count();

            $suratMasukSelesai = SuratMasuk::where('bidang_id', $user->bidang_id)
                ->where('status', 'selesai')
                ->count();

            $totalSuratKeluar = null;

            $suratKeluarDraft = null;

            $suratKeluarDikirim = null;

            $suratKeluarSelesai = null;

            $suratKeluarPersetujuan = SuratKeluar::where('status', 'menunggu_persetujuan')->count();

            $totalBidang = null;

            $totalUser = null;

            $suratMasukPerBulan = [];
            $suratKeluarPerBulan = [];

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $suratMasukPerBulan[] = SuratMasuk::where('bidang_id', $user->bidang_id)
                    ->whereYear('tanggal_surat', now()->year)
                    ->whereMonth('tanggal_surat', $bulan)
                    ->count();

                $suratKeluarPerBulan[] = 0;
            }
        }

        $bulanLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        return view('dashboard', compact(
            'totalSuratMasuk',
            'suratMasukBelumDiproses',
            'suratMasukDiproses',
            'suratMasukSelesai',
            'totalSuratKeluar',
            'suratKeluarDraft',
            'suratKeluarDikirim',
            'suratKeluarSelesai',
            'suratKeluarPersetujuan',
            'totalBidang',
            'totalUser',
            'bulanLabels',
            'suratMasukPerBulan',
            'suratKeluarPerBulan'
        ));
    }
}