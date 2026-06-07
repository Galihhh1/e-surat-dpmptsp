<x-app-layout>
    <x-slot name="header">Edit Bidang</x-slot>

    <div class="max-w-2xl mx-auto animate-fade-up">
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
                    <h2 class="text-sm font-bold text-slate-800">Edit Bidang</h2>
                    <p class="text-xs text-slate-500">{{ $bidang->nama_bidang }}</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bidangs.update', $bidang->id) }}" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="form-label">Nama Bidang</label>
                    <input type="text" name="nama_bidang" value="{{ $bidang->nama_bidang }}"
                           class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="form-input">{{ $bidang->keterangan }}</textarea>
                </div>
                <hr class="dark-divider">
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-warning">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update
                    </button>
                    <a href="{{ route('bidangs.index') }}" class="btn btn-ghost">
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