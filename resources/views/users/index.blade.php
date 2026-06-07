<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>

    <div class="space-y-5 animate-fade-up">

        <div class="flex items-center justify-between">
            <p class="text-sm text-slate-400">Kelola akun pengguna sistem e-Surat.</p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="dark-table">
                    <thead>
                        <tr>
                            <th class="text-center w-12">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bidang</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center text-slate-500 text-xs">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                             style="background: linear-gradient(135deg, #14b8a6, #8b5cf6);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-slate-800 font-medium text-sm">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-slate-600 text-sm">{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'admin_tu' ? 'badge-valid' : 'badge-disp' }}">
                                        {{ str_replace('_', ' ', $user->role) }}
                                    </span>
                                </td>
                                <td class="text-slate-600 text-sm">{{ $user->bidang->nama_bidang ?? '—' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus user ini?')"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>