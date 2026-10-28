<x-layouts.app title="Audit Log & Moderasi Chat" activeRoute="admin.audit-logs">
    <div class="space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Audit Log & Moderasi Obrolan</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Kepatuhan UU Pelindungan Data Pribadi (UU PDP): Semua akses data dan tindakan tercatat permanen.
            </p>
        </div>

        <!-- Ruang Obrolan Aktif di Sekolah -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Direktori Ruang Chat Sekolah ({{ $chatRooms->count() }})</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Siswa Dibahas</th>
                            <th class="px-4 py-3 font-semibold">Kelas</th>
                            <th class="px-4 py-3 font-semibold">Guru Pengampu</th>
                            <th class="px-4 py-3 font-semibold">Wali Murid</th>
                            <th class="px-4 py-3 font-semibold">Mata Pelajaran</th>
                            <th class="px-4 py-3 font-semibold">Pesan Terakhir</th>
                            <th class="px-4 py-3 font-semibold">Status Room</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @forelse($chatRooms as $cr)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $cr->student->full_name ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $cr->class->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#1A73E8] font-medium">{{ $cr->teacher->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#202124] dark:text-[#E8EAED]">{{ $cr->guardian->name ?? '-' }}</td>
                                <td class="px-4 py-3 font-semibold">{{ $cr->subject ? $cr->subject->name : 'Wali Kelas (Umum)' }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $cr->last_message_at ? $cr->last_message_at->diffForHumans() : '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $cr->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $cr->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-[#5F6368] dark:text-[#9AA0A6] italic">
                                    Belum ada ruang obrolan terbuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Log Audit Lengkap -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Riwayat Audit Log Sistem</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Waktu</th>
                            <th class="px-4 py-3 font-semibold">Pelaku</th>
                            <th class="px-4 py-3 font-semibold">Aksi</th>
                            <th class="px-4 py-3 font-semibold">Entitas & ID</th>
                            <th class="px-4 py-3 font-semibold">Detail Parameter</th>
                            <th class="px-4 py-3 font-semibold">IP Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6]">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="px-4 py-2.5 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $log->user->name ?? 'Sistem' }}</td>
                                <td class="px-4 py-2.5 font-mono text-[#1A73E8]">{{ $log->action }}</td>
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6]">{{ $log->entity }} #{{ $log->entity_id }}</td>
                                <td class="px-4 py-2.5 text-[11px] font-mono text-[#5F6368] dark:text-[#9AA0A6]">{{ json_encode($log->details) }}</td>
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6] font-mono">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-[#5F6368] dark:text-[#9AA0A6] italic">
                                    Belum ada log audit tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>

