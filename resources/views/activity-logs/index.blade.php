<x-app-layout>
    <x-slot name="header">Activity Log</x-slot>

    <div class="animate-fade-up">

        <div class="glass-card overflow-hidden">
            <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color: var(--border);">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <h2 class="text-sm font-bold text-slate-800">Riwayat Aktivitas Sistem</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="dark-table">
                    <thead>
                        <tr>
                            <th class="text-center w-12">No</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Keterangan</th>
                            <th>Model</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activityLogs as $log)
                            <tr>
                                <td class="text-center text-slate-500 text-xs">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-lg flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0"
                                             style="background: linear-gradient(135deg, #1d4ed8, #3b82f6);">
                                            {{ strtoupper(substr($log->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="text-slate-800 font-medium text-sm">{{ $log->user->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-disp text-xs">{{ $log->aktivitas }}</span>
                                </td>
                                <td class="text-slate-600 text-sm max-w-xs">{{ $log->keterangan }}</td>
                                <td class="text-slate-500 text-xs font-mono">
                                    {{ $log->model ?? '—' }}
                                    @if($log->model_id)
                                        <span class="text-slate-500">#{{ $log->model_id }}</span>
                                    @endif
                                </td>
                                <td class="text-slate-500 text-xs whitespace-nowrap">
                                    {{ $log->created_at->format('d M Y') }}<br>
                                    <span class="text-slate-400">{{ $log->created_at->format('H:i:s') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3 text-slate-500">
                                        <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <p class="text-sm">Belum ada activity log.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($activityLogs->hasPages())
            <div class="px-6 py-4 border-t" style="border-color: var(--border);">
                {{ $activityLogs->links() }}
            </div>
            @endif
        </div>

    </div>
</x-app-layout>