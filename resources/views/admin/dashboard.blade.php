<x-layouts.app title="Dasbor Admin Sekolah" activeRoute="admin.dashboard">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Dasbor Administrator</h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300">
                    Admin Sekolah
                </span>
            </div>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                {{ $school->name ?? 'MitraDidik School' }} • NPSN: {{ $school->npsn ?? '-' }}
            </p>
        </div>

        <!-- Quiet Hours Indicator Pill -->
        <div class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl border {{ $stats['quiet_hours_active'] ? 'bg-[#FEF7E0] border-[#FEEFC3] text-[#B06000] dark:bg-[#3E3821] dark:border-[#5E521F] dark:text-[#FDD663]' : 'bg-[#E6F4EA] border-[#CEEAD6] text-[#188038] dark:bg-[#13381B] dark:border-[#1E5C2B] dark:text-[#81C995]' }}">
            <span class="w-2.5 h-2.5 rounded-full {{ $stats['quiet_hours_active'] ? 'bg-[#F9AB00] animate-pulse' : 'bg-[#188038]' }}"></span>
            <div class="text-xs">
                <span class="font-bold">{{ $stats['quiet_hours_active'] ? 'Jam Tenang Aktif' : 'Jam Kerja Dinas' }}</span>
                <span class="block text-[11px] opacity-80">({{ substr($school->quiet_start ?? '17:00', 0, 5) }} - {{ substr($school->quiet_end ?? '07:00', 0, 5) }})</span>
            </div>
        </div>
    </div>

    <!-- Statistik Ringkasan Grid (6 Kartu) -->
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-3 sm:gap-4">
        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Total Guru</span>
            <p class="text-2xl font-bold text-[#1A73E8] dark:text-[#8AB4F8] mt-1">{{ $stats['total_teachers'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Mapel & Wali Kelas</span>
        </div>

        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Orang Tua / Wali</span>
            <p class="text-2xl font-bold text-[#188038] dark:text-[#81C995] mt-1">{{ $stats['total_guardians'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Akun Terdaftar</span>
        </div>

        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Siswa Dipantau</span>
            <p class="text-2xl font-bold text-[#202124] dark:text-[#E8EAED] mt-1">{{ $stats['total_students'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Subjek Data</span>
        </div>

        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Kelas Aktif</span>
            <p class="text-2xl font-bold text-[#C26401] dark:text-[#FCAD70] mt-1">{{ $stats['total_classes'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Rombongan Belajar</span>
        </div>

        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Mata Pelajaran</span>
            <p class="text-2xl font-bold text-[#8430CE] dark:text-[#D7AEFB] mt-1">{{ $stats['total_subjects'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Terjadwal</span>
        </div>

        <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Ruang Obrolan</span>
            <p class="text-2xl font-bold text-[#1A73E8] dark:text-[#8AB4F8] mt-1">{{ $stats['total_chat_rooms'] }}</p>
            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">Terkontekstualisasi</span>
        </div>
    </div>

    <!-- Kelas & Wali Kelas Grid -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Daftar Rombongan Belajar & Wali Kelas</h2>
            <a href="{{ route('admin.classes') }}" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">Kelola Kelas &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($classes as $c)
                <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">{{ $c->name }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-[#E8F0FE] text-[#1A73E8] font-semibold">
                            {{ $c->students->count() }} Siswa
                        </span>
                    </div>

                    <div class="text-xs space-y-1 text-[#5F6368] dark:text-[#9AA0A6]">
                        <p>
                            <strong class="text-[#202124] dark:text-[#E8EAED]">Wali Kelas:</strong>
                            {{ $c->homeroomTeacher ? $c->homeroomTeacher->teacher->name : 'Belum Ditugaskan' }}
                        </p>
                        <p>
                            <strong class="text-[#202124] dark:text-[#E8EAED]">Tingkatan:</strong>
                            Kelas {{ $c->grade_level }}
                        </p>
                    </div>

                    <div class="pt-2 border-t border-[#DADCE0] dark:border-[#3C4043] flex justify-end">
                        <a href="{{ route('admin.class-teachers') }}" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] font-medium hover:underline">
                            Atur Guru Mapel
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Audit Log Terbaru -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Aktivitas Sistem & Log Audit Kepatuhan</h2>
            <a href="{{ route('admin.audit-logs') }}" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">Lihat Semua Log &rarr;</a>
        </div>

        <div class="rounded-xl border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Waktu</th>
                            <th class="px-4 py-3 font-semibold">Pengguna</th>
                            <th class="px-4 py-3 font-semibold">Tindakan</th>
                            <th class="px-4 py-3 font-semibold">Entitas</th>
                            <th class="px-4 py-3 font-semibold">IP Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @forelse($recentAudits as $log)
                            <tr class="hover:bg-[#F8F9FA]/60 dark:hover:bg-[#202124]/40">
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6]">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2.5 font-medium text-[#202124] dark:text-[#E8EAED]">{{ $log->user->name ?? 'Sistem' }}</td>
                                <td class="px-4 py-2.5"><span class="px-2 py-0.5 rounded font-mono bg-[#E8F0FE] text-[#1A73E8] text-[11px]">{{ $log->action }}</span></td>
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6]">{{ $log->entity }} #{{ $log->entity_id }}</td>
                                <td class="px-4 py-2.5 text-[#5F6368] dark:text-[#9AA0A6] font-mono text-[11px]">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-[#5F6368] dark:text-[#9AA0A6] italic">
                                    Belum ada catatan log audit aktivitas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

