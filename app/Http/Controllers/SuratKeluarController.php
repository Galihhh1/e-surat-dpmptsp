<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
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

    private function generateNomorSurat(): string
    {
        $tahun = now()->year;
        $bulan = now()->month;

        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];

        $jumlahSuratTahunIni = SuratKeluar::whereYear('created_at', $tahun)->count() + 1;
        $nomorUrut = str_pad($jumlahSuratTahunIni, 3, '0', STR_PAD_LEFT);

        return $nomorUrut . '/DPMPTSP/' . $bulanRomawi[$bulan] . '/' . $tahun;
    }

    public function index(Request $request)
    {
        $query = SuratKeluar::with(['user'])
            ->where('status', '!=', 'arsip');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', '%' . $search . '%')
                    ->orWhere('tujuan_surat', 'like', '%' . $search . '%')
                    ->orWhere('perihal', 'like', '%' . $search . '%')
                    ->orWhere('jenis_surat', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suratKeluars = $query->latest()->paginate(10)->withQueryString();

        return view('surat-keluars.index', compact('suratKeluars'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $nomorSuratOtomatis = $this->generateNomorSurat();

        return view('surat-keluars.create', compact('nomorSuratOtomatis'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $request->validate([
            'tujuan_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'isi_surat' => 'nullable|string',
        ]);

        $filePath = null;

        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')
                ->store('surat-keluar', 'public');
        }

        $suratKeluar = SuratKeluar::create([
            'nomor_surat' => $this->generateNomorSurat(),
            'tujuan_surat' => $request->tujuan_surat,
            'perihal' => $request->perihal,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'file_surat' => $filePath,
            'status' => 'draft',
            'isi_surat' => $request->isi_surat,
        ]);

        $this->logAktivitas(
            'Menambah surat keluar',
            'User menambahkan surat keluar dengan nomor otomatis: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return redirect()
            ->route('surat-keluars.index')
            ->with('success', 'Surat keluar berhasil ditambahkan dengan nomor otomatis.');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load(['user']);

        return view('surat-keluars.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        return view('surat-keluars.edit', compact('suratKeluar'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:surat_keluars,nomor_surat,' . $suratKeluar->id,
            'tujuan_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'isi_surat' => 'nullable|string',
        ]);

        $filePath = $suratKeluar->file_surat;

        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')
                ->store('surat-keluar', 'public');
        }

        $suratKeluar->update([
            'nomor_surat' => $request->nomor_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'perihal' => $request->perihal,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'file_surat' => $filePath,
            'isi_surat' => $request->isi_surat,
        ]);

        $this->logAktivitas(
            'Mengedit surat keluar',
            'User memperbarui surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return redirect()
            ->route('surat-keluars.index')
            ->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $this->logAktivitas(
            'Menghapus surat keluar',
            'User menghapus surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        $suratKeluar->delete();

        return redirect()
            ->route('surat-keluars.index')
            ->with('success', 'Surat keluar berhasil dihapus.');
    }

    public function exportPdf()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $suratKeluars = SuratKeluar::latest()->get();
        $pdf = Pdf::loadView('surat-keluars.pdf', compact('suratKeluars'));

        return $pdf->download('laporan-surat-keluar.pdf');
    }

    public function exportExcel()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        $suratKeluars = SuratKeluar::with('user')->latest()->get();

        return response()
            ->view('surat-keluars.excel', compact('suratKeluars'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="laporan-surat-keluar.xls"');
    }

    public function ajukanPersetujuan(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        if (!in_array($suratKeluar->status, ['draft', 'ditolak'])) {
            return back()->with('error', 'Status surat tidak valid untuk diajukan persetujuan.');
        }

        $suratKeluar->update(['status' => 'menunggu_persetujuan']);

        $this->logAktivitas(
            'Mengajukan persetujuan surat keluar',
            'User mengajukan persetujuan untuk surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return back()->with('success', 'Surat keluar berhasil diajukan untuk persetujuan.');
    }

    public function setujui(Request $request, SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'user_bidang') {
            abort(403);
        }

        if ($suratKeluar->status !== 'menunggu_persetujuan') {
            return back()->with('error', 'Surat tidak sedang menunggu persetujuan.');
        }

        $request->validate([
            'catatan_approval' => 'nullable|string|max:1000',
        ]);

        $suratKeluar->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'catatan_approval' => $request->catatan_approval,
            'catatan_penolakan' => null,
        ]);

        $this->logAktivitas(
            'Menyetujui surat keluar',
            'User menyetujui surat keluar: ' . $suratKeluar->nomor_surat . ($request->catatan_approval ? ' dengan catatan: ' . $request->catatan_approval : ''),
            'SuratKeluar',
            $suratKeluar->id
        );

        return back()->with('success', 'Surat keluar berhasil disetujui.');
    }

    public function tolak(Request $request, SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'user_bidang') {
            abort(403);
        }

        if ($suratKeluar->status !== 'menunggu_persetujuan') {
            return back()->with('error', 'Surat tidak sedang menunggu persetujuan.');
        }

        $request->validate([
            'catatan_penolakan' => 'required|string|max:1000',
        ]);

        $suratKeluar->update([
            'status' => 'ditolak',
            'catatan_penolakan' => $request->catatan_penolakan,
            'catatan_approval' => null,
        ]);

        $this->logAktivitas(
            'Menolak surat keluar',
            'User menolak surat keluar: ' . $suratKeluar->nomor_surat . ' dengan alasan: ' . $request->catatan_penolakan,
            'SuratKeluar',
            $suratKeluar->id
        );

        return back()->with('success', 'Surat keluar telah ditolak.');
    }

    public function kirim(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        if ($suratKeluar->status !== 'disetujui') {
            return back()->with('error', 'Surat harus disetujui terlebih dahulu.');
        }

        $suratKeluar->update(['status' => 'dikirim']);

        $this->logAktivitas(
            'Mengirim surat keluar',
            'User menandai dikirim surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return back()->with('success', 'Surat keluar berhasil ditandai sebagai dikirim.');
    }

    public function selesai(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        if ($suratKeluar->status !== 'dikirim') {
            return back()->with('error', 'Surat harus dikirim terlebih dahulu.');
        }

        $suratKeluar->update(['status' => 'selesai']);

        $this->logAktivitas(
            'Menyelesaikan surat keluar',
            'User menandai selesai surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return back()->with('success', 'Surat keluar berhasil ditandai sebagai selesai.');
    }

    public function arsipkan(SuratKeluar $suratKeluar)
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }

        if ($suratKeluar->status !== 'selesai') {
            return back()->with('error', 'Surat harus selesai terlebih dahulu.');
        }

        $suratKeluar->update(['status' => 'arsip']);

        $this->logAktivitas(
            'Mengarsipkan surat keluar',
            'User mengarsipkan surat keluar: ' . $suratKeluar->nomor_surat,
            'SuratKeluar',
            $suratKeluar->id
        );

        return redirect()->route('surat-keluars.index')->with('success', 'Surat keluar berhasil diarsipkan.');
    }

    public function preview(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load(['user']);
        return view('surat-keluars.preview', compact('suratKeluar'));
    }

    public function cetakPdf(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load('user');
        $pdf = Pdf::loadView('surat-keluars.cetak-pdf', compact('suratKeluar'));
        return $pdf->stream($suratKeluar->id . '_surat_resmi.pdf');
    }
}