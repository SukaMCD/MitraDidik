<x-layouts.app title="Dasbor Guru" activeRoute="teacher.dashboard">
    <!-- Header Guru -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">
                    Selamat Datang, {{ $teacher->name }}
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                    Guru Pendidik
                </span>
            </div>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                @if($homeroomClass)
                    Wali Kelas: <strong>{{ $homeroomClass->name }}</strong> ({{ $homeroomClass->students->count() }} Siswa)
                @else
                    Guru Mata Pelajaran
                @endif
            </p>
        </div>

        <!-- Tombol Aksi Cepat Guru (Floating Action Style) -->
        <div class="flex items-center gap-2.5">
            <a href="{{ route('teacher.attendance') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1A73E8] hover:bg-[#1557B0] text-white text-xs font-bold shadow-sm transition-all hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                <span>Catat Presensi Harian</span>
            </a>
        </div>
    </div>

    <!-- Peringatan Permohonan Izin Menunggu Konfirmasi -->
    @if($pendingLeaveRequests > 0)
        <div class="flex items-center justify-between p-4 rounded-xl bg-[#FEF7E0] dark:bg-[#3E3821] border border-[#FEEFC3] dark:border-[#5E521F] shadow-xs">
            <div class="flex items-center gap-3">
                <span class="p-2 rounded-full bg-[#F9AB00] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </span>
                <div>
                    <h3 class="text-xs sm:text-sm font-bold text-[#B06000] dark:text-[#FDD663]">
                        Ada {{ $pendingLeaveRequests }} Permohonan Izin/Sakit Menunggu Konfirmasi Anda
                    </h3>
                    <p class="text-xs text-[#B06000]/80 dark:text-[#FDD663]/80">Orang tua murid telah mengajukan surat permohonan tidak masuk.</p>
                </div>
            </div>
            <a href="{{ route('teacher.leave-requests') }}" class="px-4 py-1.5 rounded-full bg-[#F9AB00] hover:bg-[#D98200] text-white text-xs font-bold transition-colors shadow-xs">
                Verifikasi Sekarang
            </a>
        </div>
    @endif

    <!-- Kelas & Mapel yang Diampu -->
    <div class="space-y-3">
        <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Rombongan Belajar & Mata Pelajaran yang Anda Ajar</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($classTeachers as $ct)
                <div class="p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">{{ $ct->class->name ?? '-' }}</span>
                        @if($ct->is_homeroom)
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                Wali Kelas
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800">
                                Guru Mapel
                            </span>
                        @endif
                    </div>

                    <div class="text-xs text-[#5F6368] dark:text-[#9AA0A6] space-y-1">
                        <p>
                            <strong class="text-[#202124] dark:text-[#E8EAED]">Mata Pelajaran:</strong>
                            {{ $ct->subject ? $ct->subject->name : 'Bimbingan Wali Kelas' }}
                        </p>
                        <p>
                            <strong class="text-[#202124] dark:text-[#E8EAED]">Jumlah Siswa:</strong>
                            {{ $ct->class->students->count() ?? 0 }} Siswa
                        </p>
                    </div>

                    <div class="pt-3 border-t border-[#DADCE0] dark:border-[#3C4043] flex items-center justify-between text-xs">
                        <a href="{{ route('teacher.assignments') }}" class="text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">Kelola Tugas</a>
                        <a href="{{ route('teacher.chat') }}" class="text-[#5F6368] dark:text-[#9AA0A6] hover:text-[#1A73E8] font-medium">Buka Chat Wali</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>

