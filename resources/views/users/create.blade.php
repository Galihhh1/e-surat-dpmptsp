<x-app-layout>
    <x-slot name="header">Tambah User</x-slot>

    <div class="max-w-2xl mx-auto animate-fade-up">
        <div class="form-card">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: rgba(30,64,175,0.1); border: 1px solid rgba(30,64,175,0.15);">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Tambah User</h2>
                    <p class="text-xs text-slate-500">Buat akun pengguna baru</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-danger mb-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-input" placeholder="Nama lengkap" required>
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-input" placeholder="email@dpmptsp.go.id" required>
                </div>
                <div>
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-input" placeholder="Minimal 8 karakter" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin_tu">Admin TU</option>
                            <option value="user_bidang">User Bidang</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Bidang</label>
                        <select name="bidang_id" class="form-select">
                            <option value="">— Pilih Bidang —</option>
                            @foreach($bidangs as $bidang)
                                <option value="{{ $bidang->id }}" {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="dark-divider">
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-ghost">
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