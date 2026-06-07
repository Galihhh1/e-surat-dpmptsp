<x-app-layout>
    <x-slot name="header">Tambah Surat Keluar</x-slot>

    <div class="max-w-5xl mx-auto animate-fade-up">
        <div class="form-card">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Tambah Surat Keluar</h2>
                    <p class="text-xs text-slate-500">Buat draf surat keluar baru berkop resmi</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat-keluars.store') }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label">Nomor Surat (Otomatis)</label>
                    <input type="text" id="nomor_surat" value="{{ $nomorSuratOtomatis }}"
                           class="form-input" readonly>
                    <p class="text-xs text-slate-400 mt-1">Nomor resmi dibuat otomatis saat data disimpan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Tujuan Surat / Penerima</label>
                        <input type="text" id="tujuan_surat" name="tujuan_surat" value="{{ old('tujuan_surat') }}"
                               class="form-input" placeholder="Contoh: Budi Santoso / Camat Sukarame" required>
                    </div>
                    <div>
                        <label class="form-label">Jenis Surat</label>
                        <input type="text" id="jenis_surat" name="jenis_surat" value="{{ old('jenis_surat') }}"
                               class="form-input" placeholder="Contoh: Surat Izin Usaha, Surat Izin Praktik Profesi" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal" value="{{ old('perihal') }}"
                               class="form-input" placeholder="Perihal surat perizinan" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', date('Y-m-d')) }}"
                               class="form-input" required>
                    </div>
                </div>

                {{-- Editor Surat --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="form-label mb-0">Isi Naskah Surat</label>
                    </div>
                    
                    <input type="hidden" name="isi_surat" id="isi_surat">
                    
                    {{-- Quill Editor Snow Theme --}}
                    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
                    <style>
                        .ql-editor {
                            min-height: 400px;
                            font-family: 'Times New Roman', Times, serif;
                            font-size: 15px;
                            line-height: 1.5;
                            color: #1e293b;
                            background: #ffffff;
                            padding: 2.5rem;
                        }
                        .ql-toolbar.ql-snow {
                            border-top-left-radius: 8px;
                            border-top-right-radius: 8px;
                            background: #f8fafc;
                            border-color: #d1d5db;
                        }
                        .ql-container.ql-snow {
                            border-bottom-left-radius: 8px;
                            border-bottom-right-radius: 8px;
                            border-color: #d1d5db;
                        }
                    </style>
                    <div id="editor">
                        {!! old('isi_surat') !!}
                    </div>
                </div>

                <div>
                    <label class="form-label">Lampiran Berkas Pendukung (PDF) - Opsional</label>
                    <input type="file" name="file_surat" accept="application/pdf"
                           class="form-input" style="padding: 0.5rem;">
                    <p class="text-xs text-slate-400 mt-1">Gunakan jika ada lampiran eksternal tambahan di luar isi naskah.</p>
                </div>

                <hr class="dark-divider">
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan &amp; Buat Draf
                    </button>
                    <a href="{{ route('surat-keluars.index') }}" class="btn btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['clean']
                    ]
                }
            });

            const form = document.querySelector('form');
            form.onsubmit = function() {
                const isiSuratInput = document.querySelector('#isi_surat');
                isiSuratInput.value = quill.root.innerHTML;
            };
        });
    </script>
</x-app-layout>