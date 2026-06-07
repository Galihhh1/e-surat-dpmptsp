<x-app-layout>
    <x-slot name="header">Arsip Surat</x-slot>

    {{-- Filter --}}
    <div class="glass-card p-5 mb-5 animate-fade-up">
        <form action="{{ route('arsip-surat.index') }}" method="GET"
              class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

            <div>
                <label class="form-label">Jenis Arsip</label>
                <select name="jenis" class="form-select">
                    <option value="semua"      {{ request('jenis', 'semua') == 'semua'      ? 'selected' : '' }}>Semua</option>
                    <option value="surat_masuk"  {{ request('jenis') == 'surat_masuk'  ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="surat_keluar" {{ request('jenis') == 'surat_keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select>
            </div>

            <div>
                <label class="form-label">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-input">
            </div>

            <div>
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-input">
            </div>

            @if(auth()->user()->role === 'admin_tu')
            <div>
                <label class="form-label">Bidang</label>
                <select name="bidang_id" class="form-select">
                    <option value="">Semua Bidang</option>
                    @foreach($bidangs as $bidang)
                        <option value="{{ $bidang->id }}" {{ request('bidang_id') == $bidang->id ? 'selected' : '' }}>
                            {{ $bidang->nama_bidang }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <label class="form-label">Kata Kunci</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari arsip..." class="form-input">
            </div>

            <div class="lg:col-span-5 flex gap-2 pt-1">
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('arsip-surat.index') }}" class="btn btn-ghost btn-sm">Reset</a>
            </div>
        </form>
    </div>

    {{-- Arsip Surat Masuk --}}
    @if($jenis === 'semua' || $jenis === 'surat_masuk')
    <div class="glass-card overflow-hidden mb-5 animate-fade-up-1">
        <div class="px-6 py-4 border-b flex items-center gap-2" style="border-color: var(--border);">
            <span class="badge badge-masuk">Surat Masuk</span>
            <h3 class="text-sm font-bold text-slate-800 ml-1">Arsip Surat Masuk</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="dark-table">
                <thead>
                    <tr>
                        <th class="text-center w-12">No</th>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Bidang</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratMasuks as $surat)
                        <tr>
                            <td class="text-center text-slate-500 text-xs">{{ $loop->iteration }}</td>
                            <td class="font-mono text-xs text-slate-500">{{ $surat->nomor_surat }}</td>
                            <td class="font-medium">{{ $surat->pengirim }}</td>
                            <td class="max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->bidang->nama_bidang ?? '—' }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->tanggal_surat }}</td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('surat-masuks.show', $surat->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <form action="{{ route('arsip-surat.restore-surat-masuk', $surat->id) }}"
                                          method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                onclick="return confirm('Kembalikan surat dari arsip?')"
                                                class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-500 text-sm">
                                Belum ada arsip surat masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Arsip Surat Keluar --}}
    @if($jenis === 'semua' || $jenis === 'surat_keluar')
    <div class="glass-card overflow-hidden animate-fade-up-2">
        <div class="px-6 py-4 border-b flex items-center gap-2" style="border-color: var(--border);">
            <span class="badge badge-dikirim">Surat Keluar</span>
            <h3 class="text-sm font-bold text-slate-800 ml-1">Arsip Surat Keluar</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="dark-table">
                <thead>
                    <tr>
                        <th class="text-center w-12">No</th>
                        <th>Nomor Surat</th>
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratKeluars as $surat)
                        <tr>
                            <td class="text-center text-slate-500 text-xs">{{ $loop->iteration }}</td>
                            <td class="font-mono text-xs text-slate-500">{{ $surat->nomor_surat }}</td>
                            <td class="font-medium">{{ $surat->tujuan_surat }}</td>
                            <td class="max-w-xs truncate">{{ $surat->perihal }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->tanggal_surat }}</td>
                            <td class="text-slate-600 text-sm">{{ $surat->user->name ?? '—' }}</td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('surat-keluars.show', $surat->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @if(auth()->user()->role === 'admin_tu')
                                    <form action="{{ route('arsip-surat.restore-surat-keluar', $surat->id) }}"
                                          method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                onclick="return confirm('Kembalikan surat dari arsip?')"
                                                class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-500 text-sm">
                                Belum ada arsip surat keluar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

</x-app-layout>