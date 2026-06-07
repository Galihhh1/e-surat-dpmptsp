<x-app-layout>
    <x-slot name="header">Edit Surat Keluar</x-slot>

    <div class="max-w-5xl mx-auto animate-fade-up">
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
                    <h2 class="text-sm font-bold text-slate-800">Edit Surat Keluar</h2>
                    <p class="text-xs text-slate-500 font-mono">{{ $suratKeluar->nomor_surat }}</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat-keluars.update', $suratKeluar->id) }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor_surat" id="nomor_surat"
                           value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}"
                           class="form-input" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Tujuan Surat / Penerima</label>
                        <input type="text" id="tujuan_surat" name="tujuan_surat"
                               value="{{ old('tujuan_surat', $suratKeluar->tujuan_surat) }}"
                               class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Jenis Surat</label>
                        <input type="text" id="jenis_surat" name="jenis_surat"
                               value="{{ old('jenis_surat', $suratKeluar->jenis_surat) }}"
                               class="form-input" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Perihal</label>
                        <input type="text" id="perihal" name="perihal"
                               value="{{ old('perihal', $suratKeluar->perihal) }}"
                               class="form-input" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat"
                               value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat) }}"
                               class="form-input" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft"   {{ $suratKeluar->status == 'draft'   ? 'selected' : '' }}>Draft</option>
                            <option value="dikirim" {{ $suratKeluar->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="selesai" {{ $suratKeluar->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="arsip"   {{ $suratKeluar->status == 'arsip'   ? 'selected' : '' }}>Arsip</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Ganti Lampiran Berkas (PDF)</label>
                        <input type="file" name="file_surat" accept="application/pdf"
                               class="form-input" style="padding: 0.5rem;">
                        @if($suratKeluar->file_surat)
                            <p class="text-xs text-slate-500 mt-1">File saat ini tersedia. Upload baru untuk mengganti.</p>
                        @endif
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
                        {!! old('isi_surat', $suratKeluar->isi_surat) !!}
                    </div>
                </div>

                <hr class="dark-divider">
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-warning">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Surat
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