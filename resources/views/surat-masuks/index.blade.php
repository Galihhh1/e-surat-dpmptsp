<x-app-layout>
    <x-slot name="header">Data Surat Masuk</x-slot>

    {{-- Actions & Filters --}}
    <div class="glass-card p-5 mb-5 animate-fade-up">
        <div class="flex flex-col lg:flex-row gap-4">

            {{-- Tambah Surat --}}
            @if(auth()->user()->role === 'admin_tu')
            <div class="flex-shrink-0">
                <a href="{{ route('surat-masuks.create') }}" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Surat
                </a>
            </div>
            @endif

            {{-- Search & Filter --}}
            <form action="{{ route('surat-masuks.index') }}" method="GET"
                  class="flex flex-wrap gap-2 flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-input flex-1 min-w-40"
                       placeholder="Cari nomor, pengirim, perihal...">
                <select name="status" class="form-select w-auto">
                    <option value="">Semua Status</option>
                    <option value="masuk"         {{ request('status') == 'masuk'         ? 'selected' : '' }}>Masuk</option>
                    <option value="didisposisikan" {{ request('status') == 'didisposisikan'? 'selected' : '' }}>Didisposisikan</option>
                    <option value="diproses"       {{ request('status') == 'diproses'      ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai"        {{ request('status') == 'selesai'       ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn btn-ghost">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                <a href="{{ route('surat-masuks.index') }}" class="btn btn-ghost">Reset</a>
            </form>

            {{-- Export --}}
            <form action="{{ route('surat-masuks.export-pdf') }}" method="GET"
                  class="flex flex-wrap gap-2 items-center flex-shrink-0">
                <input type="date" name="tanggal_awal" class="form-input w-auto text-sm">
                <input type="date" name="tanggal_akhir" class="form-input w-auto text-sm">
                <button type="submit" class="btn btn-danger btn-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    PDF
                </button>
                <button type="submit" formaction="{{ route('surat-masuks.export-excel') }}" class="btn btn-success btn-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Excel
                </button>
            </form>

        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
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
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Bidang</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratMasuks as $surat)
                        <tr>
                            <td class="text-center text-slate-500 text-xs">
                                {{ $suratMasuks->firstItem() + $loop->index }}
                            </td>
                            <td class="font-mono text-xs text-slate-500">{{ $surat->nomor_surat }}</td>
                            <td class="font-medium">{{ $surat->pengirim }}</td>
                            <td class="max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->bidang->nama_bidang ?? '—' }}</td>
                            <td class="text-center">
                                @if($surat->status == 'masuk')
                                    <span class="badge badge-masuk">Masuk</span>
                                @elseif($surat->status == 'didisposisikan')
                                    <span class="badge badge-disp">Disposisi</span>
                                @elseif($surat->status == 'diproses')
                                    <span class="badge badge-diproses">Diproses</span>
                                @elseif($surat->status == 'selesai')
                                    <span class="badge badge-selesai">Selesai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                    <a href="{{ route('surat-masuks.show', $surat->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @if(auth()->user()->role === 'admin_tu')
                                        <a href="{{ route('surat-masuks.edit', $surat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('surat-masuks.destroy', $surat->id) }}"
                                              method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus surat ini?')"
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-sm">Belum ada data surat masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($suratMasuks->hasPages())
        <div class="px-6 py-4 border-t" style="border-color: var(--border);">
            {{ $suratMasuks->links() }}
        </div>
        @endif
    </div>

</x-app-layout>