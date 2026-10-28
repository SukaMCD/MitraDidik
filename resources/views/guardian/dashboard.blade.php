<x-layouts.app title="Beranda Orang Tua" activeRoute="guardian.dashboard" :activeStudent="$activeStudent" :guardiansStudents="$guardiansStudents">
    <!-- Header Sapaan Orang Tua & Pemilih Anak -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">
                    Halo, {{ $guardian->name }}
                </h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                    Wali Murid
                </span>
            </div>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Memantau perkembangan: <strong class="text-[#202124] dark:text-[#E8EAED]">{{ $activeStudent->full_name }}</strong> ({{ $activeStudent->class->name ?? '' }})
            </p>
        </div>

        <!-- Tombol Aksi Cepat Orang Tua (FAB Style) -->
        <div class="flex items-center gap-2.5">
            <a href="{{ route('guardian.leave-request') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1A73E8] hover:bg-[#1557B0] text-white text-xs font-bold shadow-sm transition-all hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>Ajukan Izin / Sakit</span>
            </a>
        </div>
    </div>

    <!-- Baris Status Kehadiran Hari Ini & Poin Karakter -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Kartu Kehadiran Hari Ini -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Presensi Hari Ini ({{ \Carbon\Carbon::today()->translatedFormat('l, d F Y') }})</span>
                <div class="flex items-center gap-2.5 pt-1">
                    @if($todayAttendance)
                        <x-status-chip :status="$todayAttendance->status" size="md" />
                        @if($todayAttendance->status === 'terlambat')
                            <span class="text-xs text-[#B06000] font-medium">Terlambat {{ $todayAttendance->minutes_late }} Menit</span>
                        @endif
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-xs text-gray-600 dark:text-gray-300 font-medium">
                            <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                            Belum Ada Catatan Presensi
                        </span>
                    @endif
                </div>
            </div>

            <a href="{{ route('guardian.attendance') }}" class="text-xs font-semibold text-[#1A73E8] dark:text-[#8AB4F8] hover:underline flex items-center gap-1">
                <span>Rekap Bulanan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Kartu Karakter: Merit Budi Luhur & Demerit -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Buku Saku Perilaku & Budi Luhur</span>
                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <!-- Poin Demerit (100 -> 0) -->
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Kedisiplinan:</span>
                        <span class="text-sm font-bold {{ ($behaviorProfile->current_demerit_points ?? 100) >= 85 ? 'text-[#188038]' : (($behaviorProfile->current_demerit_points ?? 100) >= 70 ? 'text-[#B06000]' : 'text-[#D93025]') }}">
                            {{ $behaviorProfile->current_demerit_points ?? 100 }} / 100 Poin
                        </span>
                    </div>

                    <!-- Merit Budi Luhur -->
                    <div class="flex items-center gap-1.5 pl-3 border-l border-[#DADCE0] dark:border-[#3C4043]">
                        <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Budi Luhur:</span>
                        <span class="text-sm font-bold text-[#0B8043] flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-[#F9AB00]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            +{{ $behaviorProfile->total_merit_points ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('guardian.behavior') }}" class="text-xs font-semibold text-[#1A73E8] dark:text-[#8AB4F8] hover:underline flex items-center gap-1">
                <span>Lihat Buku Saku</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    <!-- Bagian 1: Kartu Mata Pelajaran Anak (Google Classroom Grid) -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Mata Pelajaran & Guru Pengampu</h2>
                <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Kartu ruang kelas anak Anda dengan warna identitas yang konsisten.</p>
            </div>
            <a href="{{ route('guardian.assignments') }}" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">Semua Tugas &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($subjects as $sub)
                @php
                    $teacherAlloc = $sub->classTeachers->first();
                    $teacherName = $teacherAlloc ? $teacherAlloc->teacher->name : 'Guru Pengampu';
                @endphp
                <x-subject-card 
                    :subjectName="$sub->name"
                    :teacherName="$teacherName"
                    :bannerColor="$sub->banner_color"
                    :gradeOrClass="$activeStudent->class->name ?? ''"
                    :upcomingDeadline="$sub->name === 'Matematika' ? 'Latihan 3: Aljabar - Besok 23:59' : null"
                    :uncompletedCount="$sub->name === 'Matematika' ? 0 : 1"
                    detailUrl="{{ route('guardian.assignments') }}?subject_id={{ $sub->id }}"
                    assignmentUrl="{{ route('guardian.assignments') }}?subject_id={{ $sub->id }}"
                    gradeUrl="{{ route('guardian.grades') }}?subject_id={{ $sub->id }}"
                    chatUrl="{{ route('guardian.chat') }}?teacher_id={{ $teacherAlloc->teacher_id ?? '' }}"
                />
            @endforeach
        </div>
    </div>

    <!-- Bagian 2: Baris Tugas Mendatang (Classwork Style Accordion) -->
    <div class="space-y-3 pt-2">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Tugas Mendatang & Pekerjaan Rumah</h2>
            <a href="{{ route('guardian.assignments') }}" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">Lihat Semua Tugas &rarr;</a>
        </div>

        <div class="space-y-2.5">
            @forelse($upcomingAssignments as $assign)
                @php
                    $submission = $assign->submissions->first();
                    $status = $submission ? $submission->status : 'belum';
                    $score = $submission ? $submission->score : null;
                    $feedback = $submission ? $submission->teacher_feedback : null;
                @endphp
                <x-assignment-row 
                    :title="$assign->title"
                    :subjectName="$assign->subject->name ?? 'Mapel'"
                    :subjectColor="$assign->subject->banner_color ?? '#1A73E8'"
                    :dueDate="$assign->due_diff_for_humans"
                    :status="$status"
                    :score="$score"
                    :maxPoints="$assign->max_points"
                    :description="$assign->description"
                    :teacherFeedback="$feedback"
                    :source="$assign->source"
                />
            @empty
                <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] text-center text-xs text-[#5F6368] dark:text-[#9AA0A6] italic shadow-xs">
                    Tidak ada tugas yang sedang aktif atau mendekati batas waktu penyerahan.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>

