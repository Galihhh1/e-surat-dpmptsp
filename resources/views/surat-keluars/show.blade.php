<x-app-layout>
    <x-slot name="header">Detail Surat Keluar</x-slot>

    <div class="max-w-5xl mx-auto space-y-5 animate-fade-up">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Meta Info Card --}}
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Detail Surat Keluar</h2>
                    <p class="text-xs text-slate-500">Informasi lengkap dokumen surat keluar</p>
                </div>
                <div class="ml-auto flex items-center gap-2">
                    @if($suratKeluar->status == 'draft')
                        <span class="badge badge-draft">Draft</span>
                    @elseif($suratKeluar->status == 'menunggu_persetujuan')
                        <span class="badge badge-diproses">Menunggu Persetujuan</span>
                    @elseif($suratKeluar->status == 'disetujui')
                        <span class="badge badge-valid">Disetujui</span>
                    @elseif($suratKeluar->status == 'ditolak')
                        <span class="badge badge-invalid">Ditolak</span>
                    @elseif($suratKeluar->status == 'dikirim')
                        <span class="badge badge-dikirim">Dikirim</span>
                    @elseif($suratKeluar->status == 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @elseif($suratKeluar->status == 'arsip')
                        <span class="badge badge-arsip">Arsip</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                @php
                $fields = [
                    ['label' => 'Nomor Surat',  'value' => $suratKeluar->nomor_surat,  'mono' => true],
                    ['label' => 'Tujuan Surat',  'value' => $suratKeluar->tujuan_surat],
                    ['label' => 'Perihal',       'value' => $suratKeluar->perihal],
                    ['label' => 'Jenis Surat',   'value' => $suratKeluar->jenis_surat],
                    ['label' => 'Tanggal Surat', 'value' => \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format('d M Y')],
                    ['label' => 'Dibuat Oleh',   'value' => $suratKeluar->user->name ?? '—'],
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

        {{-- Alur Persetujuan & Status Action Card --}}
        <div class="glass-card p-6 border-l-4 {{ $suratKeluar->status == 'ditolak' ? 'border-red-500 bg-red-50/5' : ($suratKeluar->status == 'disetujui' || $suratKeluar->status == 'selesai' || $suratKeluar->status == 'arsip' ? 'border-green-500 bg-green-50/5' : 'border-blue-500') }}">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Status Alur Persetujuan</h3>
                    <p class="text-xs text-slate-500">Pelacakan status dan tindakan persetujuan naskah dinas</p>
                </div>
            </div>

            <div class="space-y-4">
                {{-- Detail Persetujuan --}}
                @if($suratKeluar->approved_by)
                    <div class="p-4 rounded-lg bg-green-50/30 border border-green-200/50 text-xs">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <strong class="text-green-800">Dokumen Disetujui</strong>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-slate-600">
                            <div><strong>Disetujui Oleh:</strong> {{ $suratKeluar->approver->name ?? '—' }}</div>
                            <div><strong>Waktu Persetujuan:</strong> {{ \Carbon\Carbon::parse($suratKeluar->approved_at)->format('d M Y H:i') }}</div>
                        </div>
                        @if($suratKeluar->catatan_approval)
                            <div class="mt-2 pt-2 border-t border-green-200/30">
                                <strong>Catatan Approval:</strong>
                                <p class="text-slate-700 italic mt-1 bg-white/50 p-2 rounded border border-green-200/20">{{ $suratKeluar->catatan_approval }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Detail Penolakan --}}
                @if($suratKeluar->status == 'ditolak' && $suratKeluar->catatan_penolakan)
                    <div class="p-4 rounded-lg bg-red-50/30 border border-red-200/50 text-xs">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            <strong class="text-red-800">Dokumen Ditolak</strong>
                        </div>
                        <div>
                            <strong>Alasan Penolakan:</strong>
                            <p class="text-slate-700 italic mt-1 bg-white/50 p-2 rounded border border-red-200/20">{{ $suratKeluar->catatan_penolakan }}</p>
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="pt-2 border-t border-dashed border-slate-200 flex flex-wrap gap-2 items-center">
                    {{-- TU Actions --}}
                    @if(auth()->user()->role === 'admin_tu')
                        @if(in_array($suratKeluar->status, ['draft', 'ditolak']))
                            <form action="{{ route('surat-keluars.ajukan', $suratKeluar->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-primary btn-sm">
                                    🚀 Ajukan Persetujuan
                                </button>
                            </form>
                            <span class="text-xs text-slate-400">Kirim naskah ini ke User Bidang untuk diperiksa dan disetujui.</span>
                        @elseif($suratKeluar->status == 'disetujui')
                            <form action="{{ route('surat-keluars.kirim', $suratKeluar->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-purple btn-sm">
                                    📨 Kirim Surat
                                </button>
                            </form>
                            <span class="text-xs text-slate-400">Tandai surat ini telah dikirim ke penerima.</span>
                        @elseif($suratKeluar->status == 'dikirim')
                            <form action="{{ route('surat-keluars.selesai', $suratKeluar->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">
                                    ✅ Selesaikan
                                </button>
                            </form>
                            <span class="text-xs text-slate-400">Tandai alur proses surat ini telah selesai sepenuhnya.</span>
                        @elseif($suratKeluar->status == 'selesai')
                            <form action="{{ route('surat-keluars.arsipkan', $suratKeluar->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengarsipkan surat keluar ini?')" class="btn btn-ghost btn-sm border-slate-300">
                                    📦 Arsipkan Surat
                                </button>
                            </form>
                            <span class="text-xs text-slate-400">Pindahkan surat ini ke Arsip Surat (tidak akan muncul di daftar utama).</span>
                        @else
                            <span class="text-xs text-slate-500">Tidak ada tindakan alur kerja yang diperlukan saat ini.</span>
                        @endif
                    @endif

                    {{-- Bidang Actions (Approver) --}}
                    @if(auth()->user()->role === 'user_bidang')
                        @if($suratKeluar->status == 'menunggu_persetujuan')
                            <div class="w-full space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Form Setujui -->
                                    <form action="{{ route('surat-keluars.setujui', $suratKeluar->id) }}" method="POST" class="space-y-2 p-4 rounded-lg bg-slate-50 border border-slate-200">
                                        @csrf @method('PATCH')
                                        <h4 class="text-xs font-bold text-slate-700">Setujui Dokumen</h4>
                                        <textarea name="catatan_approval" rows="2" class="form-textarea text-xs" placeholder="Masukkan catatan persetujuan (opsional)..."></textarea>
                                        <button type="submit" class="btn btn-success btn-sm w-full justify-center">
                                            ✔ Setujui Surat
                                        </button>
                                    </form>

                                    <!-- Form Tolak -->
                                    <form action="{{ route('surat-keluars.tolak', $suratKeluar->id) }}" method="POST" class="space-y-2 p-4 rounded-lg bg-slate-50 border border-slate-200">
                                        @csrf @method('PATCH')
                                        <h4 class="text-xs font-bold text-slate-700">Tolak Dokumen</h4>
                                        <textarea name="catatan_penolakan" rows="2" class="form-textarea text-xs" placeholder="Masukkan alasan penolakan (wajib)..." required></textarea>
                                        <button type="submit" class="btn btn-danger btn-sm w-full justify-center">
                                            ❌ Tolak Surat
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <span class="text-xs text-slate-500">Status dokumen: <strong class="capitalize">{{ str_replace('_', ' ', $suratKeluar->status) }}</strong>. Tidak ada tindakan persetujuan yang diperlukan.</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{-- Official Letter Preview --}}
        @if ($suratKeluar->isi_surat)
        <div class="glass-card p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b" style="border-color: var(--border);">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Naskah Surat Resmi
                </h3>
                <div class="flex gap-2">
                    <a href="{{ route('surat-keluars.preview', $suratKeluar->id) }}" target="_blank" class="btn btn-ghost btn-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Preview Surat
                    </a>
                    <a href="{{ route('surat-keluars.cetak-pdf', $suratKeluar->id) }}" class="btn btn-primary btn-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Cetak PDF Surat
                    </a>
                </div>
            </div>

            {{-- Visual Paper Layout --}}
            <div class="bg-slate-100 p-6 rounded-xl overflow-auto flex justify-center">
                <div class="bg-white shadow border border-slate-200 rounded p-12 text-slate-800 text-sm max-w-2xl w-full" 
                     style="font-family: 'Times New Roman', Times, serif; line-height: 1.5; min-height: 600px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    
                    {{-- Kop Surat Bandar Lampung --}}
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px;">
                        <tr>
                            <td style="width: 12%; text-align: center; vertical-align: middle;">
                                <div style="width: 55px; height: 55px; border: 2px solid #000000; border-radius: 50%; display: inline-block; text-align: center; line-height: 55px; font-size: 8pt; font-weight: bold; font-family: Arial, sans-serif;">LOGO</div>
                            </td>
                            <td style="width: 88%; text-align: center; vertical-align: middle; font-family: Arial, sans-serif;">
                                <h4 style="font-size: 13pt; font-weight: bold; margin: 0; text-transform: uppercase; line-height: 1.2;">PEMERINTAH KOTA BANDARLAMPUNG</h4>
                                <h3 style="font-size: 14pt; font-weight: bold; margin: 2px 0 0 0; text-transform: uppercase; line-height: 1.2; letter-spacing: 0.5px;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h3>
                                <p style="font-size: 8.5pt; margin: 4px 0 0 0; line-height: 1.3;">
                                    Jalan Dr. Susilo Nomor 2 Bandarlampung, Telepon (0721) 476362<br>
                                    Faksimile (0721) 476362<br>
                                    Website: www.dpmptsp.bandarlampungkota.go.id | Pos-el: dpmptsp.kota@bandarlampungkota.go.id
                                </p>
                            </td>
                        </tr>
                    </table>
                    <div style="border-bottom: 3px double #000000; height: 1px; margin-bottom: 25px; margin-top: 5px;"></div>

                    {{-- Isi Surat HTML --}}
                    <div class="prose max-w-none text-slate-800" style="font-size: 15px;">
                        @php
                            $isiSurat = $suratKeluar->isi_surat;
                            try {
                                $qrUrl = url('/validasi-surat?nomor_surat=' . urlencode($suratKeluar->nomor_surat));
                                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate($qrUrl);
                                $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], $qrCode, $isiSurat);
                            } catch (\Exception $e) {
                                $isiSurat = str_replace(['{{ qr_code_placeholder }}', '{qr_code_placeholder}'], '[QR Code Error]', $isiSurat);
                            }
                            
                            $fotoPlaceholder = '<div style="border: 1px solid #000; width: 100px; height: 133px; line-height: 133px; text-align: center; font-size: 8pt; background: #f8fafc; color: #64748b; margin: 0 auto;">[Pas Foto 3x4]</div>';
                            $isiSurat = str_replace(['{{ foto_pemohon_placeholder }}', '{foto_pemohon_placeholder}'], $fotoPlaceholder, $isiSurat);
                        @endphp
                        {!! $isiSurat !!}
                    </div>

                </div>
            </div>
        </div>
        @endif

        {{-- Attachment Card --}}
        @if ($suratKeluar->file_surat)
        <div class="glass-card p-6">
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Lampiran Berkas PDF
            </h3>
            <a href="{{ asset('storage/' . $suratKeluar->file_surat) }}" target="_blank"
               class="btn btn-danger btn-sm mb-4">Buka di Tab Baru</a>
            <iframe src="{{ asset('storage/' . $suratKeluar->file_surat) }}"
                    width="100%" height="550" class="rounded-xl border"
                    style="border-color: var(--border);"></iframe>
        </div>
        @endif

        <div class="flex gap-3">
            <a href="{{ route('surat-keluars.index') }}" class="btn btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            @if(auth()->user()->role === 'admin_tu')
                <a href="{{ route('surat-keluars.edit', $suratKeluar->id) }}" class="btn btn-warning">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Surat
                </a>
            @endif
        </div>

    </div>
</x-app-layout>