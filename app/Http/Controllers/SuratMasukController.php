<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bidang;
use App\Models\HistoriSurat;
use App\Models\SuratMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    private function logAktivitas(string $aktivitas, ?string $keterangan = null, ?string $model = null, ?int $modelId = null): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
            'keterangan' => $keterangan,
            'model' => $model,
            'model_id' => $modelId,
        ]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = SuratMasuk::with('bidang')
            ->where('status', '!=', 'arsip');

        if ($user->role === 'user_bidang') {
            $query->where('bidang_id', $user->bidang_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhere('pengirim', 'like', '%' . $search . '%')
                    ->orWhere('perihal', 'like', '%' . $search . '%')
                    ->orWhere('jenis_surat', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suratMasuks = $query->latest()->paginate(10)->withQueryString();

        return view('surat-masuks.index', compact('suratMasuks'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $bidangs = Bidang::latest()->get();

        return view('surat-masuks.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuks,nomor_surat',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'bidang_id' => 'nullable|exists:bidangs,id',
            'catatan_disposisi' => 'nullable|string',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        $filePath = null;

        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat-masuk', 'public');
        }

        $suratMasuk = SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'file_surat' => $filePath,
            'bidang_id' => $request->bidang_id,
            'catatan_disposisi' => $request->catatan_disposisi,
            'status' => $request->bidang_id ? 'didisposisikan' : 'masuk',
        ]);

        HistoriSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'user_id' => Auth::id(),
            'aktivitas' => 'Surat masuk dibuat',
            'keterangan' => $request->bidang_id
                ? 'Surat diinput dan langsung didisposisikan ke bidang. Catatan: ' . ($request->catatan_disposisi ?? '-')
                : 'Surat diinput dan belum didisposisikan.',
        ]);

        $this->logAktivitas(
            'Menambah surat masuk',
            'User menambahkan surat masuk dengan nomor ' . $suratMasuk->nomor_surat,
            'SuratMasuk',
            $suratMasuk->id
        );

        return redirect()
            ->route('surat-masuks.index')
            ->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        $user = Auth::user();

        if ($user->role === 'user_bidang' && $suratMasuk->bidang_id !== $user->bidang_id) {
            abort(403);
        }

        $suratMasuk->load([
            'bidang',
            'historiSurats.user',
        ]);

        return view('surat-masuks.show', compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $bidangs = Bidang::latest()->get();

        return view('surat-masuks.edit', compact('suratMasuk', 'bidangs'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_masuks,nomor_surat,' . $suratMasuk->id,
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'bidang_id' => 'nullable|exists:bidangs,id',
            'catatan_disposisi' => 'nullable|string',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        $filePath = $suratMasuk->file_surat;

        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat-masuk', 'public');
        }

        $suratMasuk->update([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'file_surat' => $filePath,
            'bidang_id' => $request->bidang_id,
            'catatan_disposisi' => $request->catatan_disposisi,
            'status' => $request->bidang_id ? $suratMasuk->status : 'masuk',
        ]);

        HistoriSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'user_id' => Auth::id(),
            'aktivitas' => 'Data surat diperbarui',
            'keterangan' => 'Admin TU memperbarui data surat. Catatan disposisi: ' . ($request->catatan_disposisi ?? '-'),
        ]);

        $this->logAktivitas(
            'Mengedit surat masuk',
            'User memperbarui data surat masuk nomor ' . $suratMasuk->nomor_surat,
            'SuratMasuk',
            $suratMasuk->id
        );

        return redirect()
            ->route('surat-masuks.index')
            ->with('success', 'Data surat berhasil diperbarui.');
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $this->logAktivitas(
            'Menghapus surat masuk',
            'User menghapus surat masuk nomor ' . $suratMasuk->nomor_surat,
            'SuratMasuk',
            $suratMasuk->id
        );

        $suratMasuk->delete();

        return redirect()
            ->route('surat-masuks.index')
            ->with('success', 'Surat masuk berhasil dihapus.');
    }

    public function updateStatus(Request $request, SuratMasuk $suratMasuk)
    {
        $request->validate([
            'status' => 'required|in:masuk,didisposisikan,diproses,selesai,arsip',
        ]);

        $suratMasuk->update([
            'status' => $request->status,
        ]);

        HistoriSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'user_id' => Auth::id(),
            'aktivitas' => 'Status surat diperbarui',
            'keterangan' => 'Status diubah menjadi ' . $request->status,
        ]);

        $this->logAktivitas(
            'Mengubah status surat masuk',
            'Status surat diubah menjadi ' . $request->status,
            'SuratMasuk',
            $suratMasuk->id
        );

        return redirect()
            ->back()
            ->with('success', 'Status surat berhasil diperbarui.');
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        $query = SuratMasuk::with('bidang');

        if ($user->role !== 'admin_tu') {
            $query->where('bidang_id', $user->bidang_id);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_surat', [
                $request->tanggal_awal,
                $request->tanggal_akhir,
            ]);
        }

        $suratMasuks = $query->latest()->get();

        $pdf = Pdf::loadView('surat-masuks.pdf', compact('suratMasuks'));

        return $pdf->download('laporan-surat-masuk.pdf');
    }

    public function exportExcel(Request $request)
    {
        $user = Auth::user();

        $query = SuratMasuk::with('bidang');

        if ($user->role !== 'admin_tu') {
            $query->where('bidang_id', $user->bidang_id);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_surat', [
                $request->tanggal_awal,
                $request->tanggal_akhir,
            ]);
        }

        $suratMasuks = $query->latest()->get();

        return response()
            ->view('surat-masuks.excel', compact('suratMasuks'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="laporan-surat-masuk.xls"');
    }

    public function cetakDisposisi(SuratMasuk $suratMasuk)
    {
        $user = Auth::user();

        if ($user->role === 'user_bidang' && $suratMasuk->bidang_id !== $user->bidang_id) {
            abort(403);
        }

        $suratMasuk->load([
            'bidang',
            'historiSurats.user',
        ]);

        $pdf = Pdf::loadView('surat-masuks.disposisi-pdf', compact('suratMasuk'));

        return $pdf->download('lembar-disposisi-' . $suratMasuk->nomor_surat . '.pdf');
    }
}