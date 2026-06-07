<x-app-layout>
    <x-slot name="header">Data Bidang</x-slot>

    <div class="space-y-5 animate-fade-up">

        <div class="flex items-center justify-between">
            <p class="text-sm text-slate-400">Kelola data bidang dalam sistem.</p>
            <a href="{{ route('bidangs.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Bidang
            </a>
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="glass-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="dark-table">
                    <thead>
                        <tr>
                            <th class="text-center w-12">No</th>
                            <th>Nama Bidang</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bidangs as $bidang)
                            <tr>
                                <td class="text-center text-slate-500 text-xs">{{ $loop->iteration }}</td>
                                <td class="text-slate-800 font-medium">{{ $bidang->nama_bidang }}</td>
                                <td class="text-slate-600 text-sm">{{ $bidang->keterangan ?: '—' }}</td>
                                <td class="text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('bidangs.edit', $bidang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('bidangs.destroy', $bidang->id) }}"
                                              method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Yakin hapus data ini?')"
                                                    class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-slate-500 text-sm">
                                    Belum ada data bidang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>