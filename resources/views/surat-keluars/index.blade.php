<x-app-layout>
    <x-slot name="header">Data Surat Keluar</x-slot>

    {{-- Actions & Filter --}}
    <div class="glass-card p-5 mb-5 animate-fade-up">
        <div class="flex flex-col lg:flex-row gap-4">

            @if(auth()->user()->role === 'admin_tu')
            <div class="flex flex-wrap gap-2 flex-shrink-0">
                <a href="{{ route('surat-keluars.create') }}" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Surat
                </a>
                <a href="{{ route('surat-keluars.export-pdf') }}" class="btn btn-danger">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('surat-keluars.export-excel') }}" class="btn btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Excel
                </a>
            </div>
            @endif

            <form action="{{ route('surat-keluars.index') }}" method="GET"
                  class="flex flex-wrap gap-2 flex-1 items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-input flex-1 min-w-40" placeholder="Cari surat keluar...">
                <select name="status" class="form-select w-auto">
                    <option value="">Semua Status</option>
                    <option value="draft"   {{ request('status') == 'draft'   ? 'selected' : '' }}>Draft</option>
                    <option value="menunggu_persetujuan" {{ request('status') == 'menunggu_persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn btn-ghost">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                <a href="{{ route('surat-keluars.index') }}" class="btn btn-ghost">Reset</a>
            </form>

        </div>
    </div>

    @if(session('success'))
        <div class="alert-success mb-5 animate-fade-up">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="glass-card overflow-hidden animate-fade-up-1">
        <div class="overflow-x-auto">
            <table class="dark-table">
                <thead>
                     <tr>
                        <th class="text-center w-12">No</th>
                        <th>Nomor Surat</th>
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratKeluars as $surat)
                        <tr>
                            <td class="text-center text-slate-500 text-xs">{{ $suratKeluars->firstItem() + $loop->index }}</td>
                            <td class="font-mono text-xs text-slate-500">{{ $surat->nomor_surat }}</td>
                            <td class="font-medium">{{ $surat->tujuan_surat }}</td>
                            <td class="max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->tanggal_surat }}</td>
                            <td class="text-center">
                                @if($surat->status == 'draft')
                                    <span class="badge badge-draft">Draft</span>
                                @elseif($surat->status == 'menunggu_persetujuan')
                                    <span class="badge badge-diproses">Menunggu Persetujuan</span>
                                @elseif($surat->status == 'disetujui')
                                    <span class="badge badge-valid">Disetujui</span>
                                @elseif($surat->status == 'ditolak')
                                    <span class="badge badge-invalid">Ditolak</span>
                                @elseif($surat->status == 'dikirim')
                                    <span class="badge badge-dikirim">Dikirim</span>
                                @elseif($surat->status == 'selesai')
                                    <span class="badge badge-selesai">Selesai</span>
                                @elseif($surat->status == 'arsip')
                                    <span class="badge badge-arsip">Arsip</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                    <a href="{{ route('surat-keluars.show', $surat->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @if(auth()->user()->role === 'admin_tu')
                                        <a href="{{ route('surat-keluars.edit', $surat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('surat-keluars.destroy', $surat->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus surat keluar ini?')"
                                                    class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <div class="flex flex-col items-center gap-3 text-slate-400">
                                    <svg class="w-12 h-12 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <p class="text-sm">Belum ada data surat keluar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($suratKeluars->hasPages())
        <div class="px-6 py-4 border-t" style="border-color: var(--border);">
            {{ $suratKeluars->links() }}
        </div>
        @endif
    </div>
</x-app-layout>