<x-app-layout>
    <x-slot name="header">Detail Surat Masuk</x-slot>

    <div class="max-w-5xl mx-auto space-y-5 animate-fade-up">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Main Info --}}
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Detail Surat Masuk</h2>
                    <p class="text-xs text-slate-500">Informasi lengkap dokumen surat</p>
                </div>
                <div class="ml-auto">
                    @if($suratMasuk->status == 'masuk')
                        <span class="badge badge-masuk">Masuk</span>
                    @elseif($suratMasuk->status == 'didisposisikan')
                        <span class="badge badge-disp">Didisposisikan</span>
                    @elseif($suratMasuk->status == 'diproses')
                        <span class="badge badge-diproses">Diproses</span>
                    @elseif($suratMasuk->status == 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @elseif($suratMasuk->status == 'arsip')
                        <span class="badge badge-arsip">Arsip</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                @php
                $fields = [
                    ['label' => 'Nomor Surat',     'value' => $suratMasuk->nomor_surat, 'mono' => true],
                    ['label' => 'Pengirim',         'value' => $suratMasuk->pengirim],
                    ['label' => 'Perihal',          'value' => $suratMasuk->perihal],
                    ['label' => 'Jenis Surat',      'value' => $suratMasuk->jenis_surat],
                    ['label' => 'Tanggal Surat',    'value' => $suratMasuk->tanggal_surat],
                    ['label' => 'Bidang Tujuan',    'value' => $suratMasuk->bidang->nama_bidang ?? 'Belum Didisposisikan'],
                    ['label' => 'Catatan Disposisi','value' => $suratMasuk->catatan_disposisi ?? '—'],
                ];
                @endphp
                @foreach($fields as $f)
                <div>
                    <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">{{ $f['label'] }}</p>
                    <p class="{{ ($f['mono'] ?? false) ? 'font-mono text-blue-600 font-semibold' : 'text-slate-800' }} text-sm">
                        {{ $f['value'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- PDF Preview --}}
        @if ($suratMasuk->file_surat)
        <div class="glass-card p-6">
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                File Surat PDF
            </h3>
            <a href="{{ asset('storage/' . $suratMasuk->file_surat) }}"
               target="_blank" class="btn btn-danger btn-sm mb-4">
                Buka di Tab Baru
            </a>
            <iframe src="{{ asset('storage/' . $suratMasuk->file_surat) }}"
                    width="100%" height="550"
                    class="rounded-xl border" style="border-color: var(--border);"></iframe>
        </div>
        @endif

        {{-- Update Status --}}
        <div class="glass-card p-6">
            <h3 class="text-sm font-bold text-slate-800 mb-4">Update Status Surat</h3>
            <form action="{{ route('surat-masuks.update-status', $suratMasuk->id) }}" method="POST">
                @csrf @method('PATCH')
                <div class="flex items-center gap-3 flex-wrap">
                    <select name="status" class="form-select w-auto">
                        <option value="masuk"          {{ $suratMasuk->status == 'masuk'          ? 'selected' : '' }}>Masuk</option>
                        <option value="didisposisikan" {{ $suratMasuk->status == 'didisposisikan' ? 'selected' : '' }}>Didisposisikan</option>
                        <option value="diproses"       {{ $suratMasuk->status == 'diproses'       ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"        {{ $suratMasuk->status == 'selesai'        ? 'selected' : '' }}>Selesai</option>
                        <option value="arsip"          {{ $suratMasuk->status == 'arsip'          ? 'selected' : '' }}>Arsip</option>
                    </select>
                    <button type="submit" class="btn btn-success">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Status
                    </button>
                </div>
            </form>
        </div>

        {{-- Histori --}}
        <div class="glass-card p-6">
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Histori Surat
            </h3>
            <div class="space-y-3">
                @forelse ($suratMasuk->historiSurats as $histori)
                    <div class="flex gap-4 p-4 rounded-xl" style="background: var(--border-light); border: 1px solid var(--border);">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                             style="background: rgba(139,92,246,0.15); border: 1px solid rgba(139,92,246,0.2);">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-800">{{ $histori->aktivitas }}</p>
                            <p class="text-xs text-slate-600 mt-0.5">{{ $histori->keterangan }}</p>
                            <p class="text-[11px] text-slate-500 mt-2">
                                Oleh: <span class="text-slate-700 font-medium">{{ $histori->user->name ?? '—' }}</span>
                                &middot; {{ $histori->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 py-4 text-center">Belum ada histori surat.</p>
                @endforelse
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('surat-masuks.index') }}" class="btn btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <a href="{{ route('surat-masuks.cetak-disposisi', $suratMasuk->id) }}" class="btn btn-danger">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Disposisi
            </a>
        </div>

    </div>
</x-app-layout>