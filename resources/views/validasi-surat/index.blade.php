<x-app-layout>
    <x-slot name="header">Validasi Surat</x-slot>

    <div class="max-w-4xl mx-auto space-y-5 animate-fade-up">

        {{-- Search Form --}}
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Cek Validasi Surat</h2>
                    <p class="text-xs text-slate-500">Masukkan nomor surat untuk memverifikasi keaslian dokumen</p>
                </div>
            </div>

            <form action="{{ route('validasi-surat.cek') }}" method="POST"
                  class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="nomor_surat"
                       value="{{ old('nomor_surat', $nomorSurat ?? '') }}"
                       placeholder="Masukkan nomor surat..."
                       class="form-input flex-1" required>
                <button type="submit" class="btn btn-primary flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cek Validasi
                </button>
                <a href="{{ route('validasi-surat.index') }}" class="btn btn-ghost flex-shrink-0">Reset</a>
            </form>

            @if ($errors->any())
                <div class="alert-danger mt-4">{{ $errors->first() }}</div>
            @endif
        </div>

        {{-- Result --}}
        @isset($nomorSurat)

            @if($suratMasuk)
            {{-- Valid - Surat Masuk --}}
            <div class="glass-card p-6 animate-fade-up-1">
                <div class="flex items-center gap-3 mb-6">
                    <span class="badge badge-valid">✓ Dokumen Valid</span>
                    <span class="badge badge-disp">Surat Masuk</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @php
                    $rows = [
                        ['label' => 'Nomor Surat',    'value' => $suratMasuk->nomor_surat,                        'mono' => true],
                        ['label' => 'Pengirim',        'value' => $suratMasuk->pengirim],
                        ['label' => 'Perihal',         'value' => $suratMasuk->perihal],
                        ['label' => 'Jenis Surat',     'value' => $suratMasuk->jenis_surat],
                        ['label' => 'Tanggal Surat',   'value' => $suratMasuk->tanggal_surat],
                        ['label' => 'Bidang Tujuan',   'value' => $suratMasuk->bidang->nama_bidang ?? '—'],
                    ];
                    @endphp
                    @foreach($rows as $r)
                    <div>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">{{ $r['label'] }}</p>
                        <p class="{{ ($r['mono'] ?? false) ? 'font-mono text-blue-600 font-semibold' : 'text-slate-800' }} text-sm">
                            {{ $r['value'] }}
                        </p>
                    </div>
                    @endforeach
                    <div>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Status</p>
                        @if($suratMasuk->status == 'masuk') <span class="badge badge-masuk">Masuk</span>
                        @elseif($suratMasuk->status == 'didisposisikan') <span class="badge badge-disp">Didisposisikan</span>
                        @elseif($suratMasuk->status == 'diproses') <span class="badge badge-diproses">Diproses</span>
                        @elseif($suratMasuk->status == 'selesai') <span class="badge badge-selesai">Selesai</span>
                        @elseif($suratMasuk->status == 'arsip') <span class="badge badge-arsip">Arsip</span>
                        @endif
                    </div>
                </div>
            </div>

            @elseif($suratKeluar)
            {{-- Valid - Surat Keluar --}}
            <div class="glass-card p-6 animate-fade-up-1">
                <div class="flex items-center gap-3 mb-6">
                    <span class="badge badge-valid">✓ Dokumen Valid</span>
                    <span class="badge badge-dikirim">Surat Keluar</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @php
                    $rows = [
                        ['label' => 'Nomor Surat',  'value' => $suratKeluar->nomor_surat,  'mono' => true],
                        ['label' => 'Tujuan Surat',  'value' => $suratKeluar->tujuan_surat],
                        ['label' => 'Perihal',       'value' => $suratKeluar->perihal],
                        ['label' => 'Jenis Surat',   'value' => $suratKeluar->jenis_surat],
                        ['label' => 'Tanggal Surat', 'value' => $suratKeluar->tanggal_surat],
                        ['label' => 'Dibuat Oleh',   'value' => $suratKeluar->user->name ?? '—'],
                    ];
                    @endphp
                    @foreach($rows as $r)
                    <div>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">{{ $r['label'] }}</p>
                        <p class="{{ ($r['mono'] ?? false) ? 'font-mono text-purple-600 font-semibold' : 'text-slate-800' }} text-sm">
                            {{ $r['value'] }}
                        </p>
                    </div>
                    @endforeach
                    <div>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">Status</p>
                        @if($suratKeluar->status == 'draft') <span class="badge badge-draft">Draft</span>
                        @elseif($suratKeluar->status == 'dikirim') <span class="badge badge-dikirim">Dikirim</span>
                        @elseif($suratKeluar->status == 'selesai') <span class="badge badge-selesai">Selesai</span>
                        @elseif($suratKeluar->status == 'arsip') <span class="badge badge-arsip">Arsip</span>
                        @endif
                    </div>
                </div>
            </div>

            @else
            {{-- Tidak ditemukan --}}
            <div class="glass-card p-6 animate-fade-up-1">
                <div class="flex items-center gap-3 mb-4">
                    <span class="badge badge-invalid">✗ Dokumen Tidak Ditemukan</span>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-xl"
                     style="background: rgba(239,68,68,0.07); border: 1px solid rgba(239,68,68,0.15);">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-red-800">
                        Nomor surat <span class="font-mono font-semibold">{{ $nomorSurat }}</span>
                        tidak ditemukan dalam sistem. Pastikan nomor surat yang dimasukkan benar.
                    </p>
                </div>
            </div>
            @endif

        @else
        {{-- Default state --}}
        <div class="glass-card p-10 text-center animate-fade-up-1">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4"
                 style="background: rgba(30,64,175,0.08); border: 1px solid rgba(30,64,175,0.12);">
                <svg class="w-8 h-8 text-blue-600 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="text-sm text-slate-500">Masukkan nomor surat di atas untuk memvalidasi dokumen.</p>
        </div>
        @endisset

    </div>
</x-app-layout>