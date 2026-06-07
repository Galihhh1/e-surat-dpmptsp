<x-app-layout>
    <x-slot name="header">Edit Surat Masuk</x-slot>

    <div class="max-w-3xl mx-auto animate-fade-up">
        <div class="form-card">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.15);">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Edit Surat Masuk</h2>
                    <p class="text-xs text-slate-500 font-mono">{{ $suratMasuk->nomor_surat }}</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat-masuks.update', $suratMasuk->id) }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat"
                               value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}"
                               class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Pengirim</label>
                        <input type="text" name="pengirim"
                               value="{{ old('pengirim', $suratMasuk->pengirim) }}"
                               class="form-input" required>
                    </div>
                </div>

                <div>
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal"
                           value="{{ old('perihal', $suratMasuk->perihal) }}"
                           class="form-input" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Jenis Surat</label>
                        <input type="text" name="jenis_surat"
                               value="{{ old('jenis_surat', $suratMasuk->jenis_surat) }}"
                               class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat"
                               value="{{ old('tanggal_surat', $suratMasuk->tanggal_surat) }}"
                               class="form-input" required>
                    </div>
                </div>

                <div>
                    <label class="form-label">Disposisi ke Bidang</label>
                    <select name="bidang_id" class="form-select">
                        <option value="">— Belum Didisposisikan —</option>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}"
                                {{ old('bidang_id', $suratMasuk->bidang_id) == $bidang->id ? 'selected' : '' }}>
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Catatan Disposisi</label>
                    <textarea name="catatan_disposisi" rows="3" class="form-input"
                              placeholder="Mohon segera ditindaklanjuti.">{{ old('catatan_disposisi', $suratMasuk->catatan_disposisi) }}</textarea>
                </div>

                <div>
                    <label class="form-label">Ganti File PDF</label>
                    <input type="file" name="file_surat" accept="application/pdf"
                           class="form-input" style="padding: 0.5rem;">
                    @if($suratMasuk->file_surat)
                        <p class="text-xs text-slate-500 mt-1">File saat ini tersedia. Upload baru untuk mengganti.</p>
                    @endif
                </div>

                <hr class="dark-divider">

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-warning">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update
                    </button>
                    <a href="{{ route('surat-masuks.index') }}" class="btn btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>