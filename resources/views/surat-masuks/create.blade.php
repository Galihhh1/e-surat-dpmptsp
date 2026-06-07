<x-app-layout>
    <x-slot name="header">Tambah Surat Masuk</x-slot>

    <div class="max-w-3xl mx-auto animate-fade-up">
        <div class="form-card">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Tambah Surat Masuk</h2>
                    <p class="text-xs text-slate-500">Isi formulir berikut untuk menambah surat masuk baru</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat-masuks.store') }}" method="POST" enctype="multipart/form-data"
                  class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}"
                               class="form-input" placeholder="Contoh: 001/DIR/V/2024" required>
                    </div>
                    <div>
                        <label class="form-label">Pengirim</label>
                        <input type="text" name="pengirim" value="{{ old('pengirim') }}"
                               class="form-input" placeholder="Nama instansi / pengirim" required>
                    </div>
                </div>

                <div>
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal" value="{{ old('perihal') }}"
                           class="form-input" placeholder="Perihal surat" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Jenis Surat</label>
                        <input type="text" name="jenis_surat" value="{{ old('jenis_surat') }}"
                               class="form-input" placeholder="Contoh: Surat Izin Usaha, Surat Izin Praktik Profesi" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                               class="form-input" required>
                    </div>
                </div>

                <div>
                    <label class="form-label">Disposisi ke Bidang</label>
                    <select name="bidang_id" class="form-select">
                        <option value="">— Belum Didisposisikan —</option>
                        @foreach($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                {{ $bidang->nama_bidang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Catatan Disposisi</label>
                    <textarea name="catatan_disposisi" rows="3" class="form-input"
                              placeholder="Mohon segera ditindaklanjuti.">{{ old('catatan_disposisi') }}</textarea>
                </div>

                <div>
                    <label class="form-label">File Surat (PDF)</label>
                    <input type="file" name="file_surat" accept="application/pdf"
                           class="form-input" style="padding: 0.5rem;">
                    <p class="text-xs text-slate-500 mt-1">Format PDF, maksimal 10MB</p>
                </div>

                <hr class="dark-divider">

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
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