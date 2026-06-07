<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    {{-- ─── Surat Masuk Stats ─── --}}
    <div class="mb-3 section-title">Statistik Surat Masuk</div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="stat-card stat-cyan animate-fade-up">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white mb-1">{{ $totalSuratMasuk }}</p>
            <p class="text-xs text-white/80 font-medium">Total Surat Masuk</p>
            <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full opacity-5"
                 style="background: #ffffff; transform: translate(30%, 30%);"></div>
        </div>

        <div class="stat-card stat-amber animate-fade-up-1">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white mb-1">{{ $suratMasukBelumDiproses }}</p>
            <p class="text-xs text-white/80 font-medium">Belum Diproses</p>
            <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full opacity-5"
                 style="background: #ffffff; transform: translate(30%, 30%);"></div>
        </div>

        <div class="stat-card stat-orange animate-fade-up-2">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white mb-1">{{ $suratMasukDiproses }}</p>
            <p class="text-xs text-white/80 font-medium">Sedang Diproses</p>
            <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full opacity-5"
                 style="background: #ffffff; transform: translate(30%, 30%);"></div>
        </div>

        <div class="stat-card stat-emerald animate-fade-up-3">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white mb-1">{{ $suratMasukSelesai }}</p>
            <p class="text-xs text-white/80 font-medium">Selesai</p>
            <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full opacity-5"
                 style="background: #ffffff; transform: translate(30%, 30%);"></div>
        </div>

    </div>

    @if(auth()->user()->role === 'admin_tu')

        {{-- ─── Surat Keluar Stats ─── --}}
        <div class="mb-3 section-title">Statistik Surat Keluar</div>
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">

            <div class="stat-card stat-violet animate-fade-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $totalSuratKeluar }}</p>
                <p class="text-xs text-white/80 font-medium">Total Surat Keluar</p>
                <div class="absolute bottom-0 right-0 w-24 h-24 rounded-full opacity-5"
                     style="background: #ffffff; transform: translate(30%, 30%);"></div>
            </div>

            <div class="stat-card stat-slate animate-fade-up-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $suratKeluarDraft }}</p>
                <p class="text-xs text-white/80 font-medium">Draft</p>
            </div>

            <div class="stat-card stat-amber animate-fade-up-2">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $suratKeluarPersetujuan }}</p>
                <p class="text-xs text-white/80 font-medium">Menunggu Approval</p>
            </div>

            <div class="stat-card stat-blue animate-fade-up-3">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $suratKeluarDikirim }}</p>
                <p class="text-xs text-white/80 font-medium">Dikirim</p>
            </div>

            <div class="stat-card stat-emerald animate-fade-up-4">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $suratKeluarSelesai }}</p>
                <p class="text-xs text-white/80 font-medium">Selesai</p>
            </div>

        </div>

    @else
        {{-- ─── Surat Keluar Approval Stats for Bidang ─── --}}
        <div class="mb-3 section-title">Persetujuan Surat Keluar</div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stat-card stat-amber animate-fade-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $suratKeluarPersetujuan }}</p>
                <p class="text-xs text-white/80 font-medium">Menunggu Persetujuan Anda</p>
            </div>
        </div>

        {{-- ─── Master Data Stats ─── --}}
        <div class="mb-3 section-title">Master Data</div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <div class="stat-card stat-rose animate-fade-up">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $totalBidang }}</p>
                <p class="text-xs text-white/80 font-medium">Total Bidang</p>
            </div>

            <div class="stat-card stat-purple animate-fade-up-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white mb-1">{{ $totalUser }}</p>
                <p class="text-xs text-white/80 font-medium">Total User</p>
            </div>

        </div>

    @endif

    {{-- ─── Chart ─── --}}
    <div class="glass-card p-6 animate-fade-up">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-sm font-bold text-slate-800">
                    @if(auth()->user()->role === 'admin_tu')
                        Grafik Surat Masuk &amp; Keluar
                    @else
                        Grafik Surat Masuk Bidang
                    @endif
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Tahun {{ now()->year }}</p>
            </div>
            <div class="flex items-center gap-4 text-xs text-slate-500">
                <span class="flex items-center gap-1.5 font-medium">
                    <span class="w-3 h-3 rounded-full inline-block" style="background: #14b8a6;"></span>
                    Surat Masuk
                </span>
                @if(auth()->user()->role === 'admin_tu')
                <span class="flex items-center gap-1.5 font-medium">
                    <span class="w-3 h-3 rounded-full inline-block" style="background: #8b5cf6;"></span>
                    Surat Keluar
                </span>
                @endif
            </div>
        </div>
        <canvas
            id="grafikSurat"
            height="90"
            data-labels='@json($bulanLabels)'
            data-surat-masuk='@json($suratMasukPerBulan)'
            data-surat-keluar='@json($suratKeluarPerBulan)'
            data-role='{{ auth()->user()->role }}'>
        </canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const canvas = document.getElementById('grafikSurat');
        const bulanLabels = JSON.parse(canvas.dataset.labels);
        const suratMasukPerBulan = JSON.parse(canvas.dataset.suratMasuk);
        const suratKeluarPerBulan = JSON.parse(canvas.dataset.suratKeluar);
        const roleUser = canvas.dataset.role;

        const datasets = [{
            label: 'Surat Masuk',
            data: suratMasukPerBulan,
            backgroundColor: 'rgba(20, 184, 166, 0.12)',
            borderColor: '#14b8a6',
            borderWidth: 2.5,
            borderRadius: 6,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#14b8a6',
            pointRadius: 4,
            pointHoverRadius: 6,
        }];

        if (roleUser === 'admin_tu') {
            datasets.push({
                label: 'Surat Keluar',
                data: suratKeluarPerBulan,
                backgroundColor: 'rgba(139, 92, 246, 0.12)',
                borderColor: '#8b5cf6',
                borderWidth: 2.5,
                borderRadius: 6,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#8b5cf6',
                pointRadius: 4,
                pointHoverRadius: 6,
            });
        }

        new Chart(canvas, {
            type: 'line',
            data: { labels: bulanLabels, datasets },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        titleColor: '#1e293b',
                        titleFont: { weight: 'bold' },
                        bodyColor: '#475569',
                        padding: 12,
                        cornerRadius: 10,
                        boxPadding: 6,
                        shadowColor: 'rgba(0, 0, 0, 0.1)',
                        shadowBlur: 10
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                        ticks: { color: '#64748b', font: { size: 11, family: 'Inter' } },
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                        ticks: { color: '#64748b', font: { size: 11, family: 'Inter' }, precision: 0 },
                    }
                }
            }
        });
    </script>
</x-app-layout>