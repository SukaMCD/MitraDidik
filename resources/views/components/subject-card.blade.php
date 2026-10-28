@props([
    'subjectName' => 'Matematika',
    'teacherName' => 'Ahmad Fauzi, S.Pd',
    'bannerColor' => '#1A73E8',
    'gradeOrClass' => 'Kelas 7A',
    'upcomingDeadline' => null, // e.g. "Latihan Aljabar 3 - Besok 23:59"
    'uncompletedCount' => 0,
    'detailUrl' => '#',
    'assignmentUrl' => '#',
    'gradeUrl' => '#',
    'chatUrl' => '#',
])

@php
    // Warna teks & pola kontras
    $bannerHex = $bannerColor ?: '#1A73E8';
@endphp

<div class="group relative flex flex-col overflow-hidden rounded-xl border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
    <!-- Banner Atas Gaya Classroom (Tinggi 104px) -->
    <div class="relative h-26 w-full p-4 text-white overflow-hidden" style="background-color: {{ $bannerHex }};">
        <!-- Pola Geometris Halus Transparan -->
        <svg class="absolute -right-4 -bottom-6 w-32 h-32 opacity-15 text-white pointer-events-none" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" />
            <path d="M10 50 Q50 10 90 50 T10 50" stroke="white" stroke-width="4" fill="none" />
            <circle cx="20" cy="30" r="10" />
            <circle cx="75" cy="75" r="12" />
        </svg>

        <div class="relative z-10 flex justify-between items-start">
            <div class="max-w-[85%]">
                <a href="{{ $detailUrl }}" class="hover:underline">
                    <h3 class="text-lg font-bold leading-snug tracking-tight line-clamp-1 drop-shadow-sm">{{ $subjectName }}</h3>
                </a>
                <p class="text-xs font-medium text-white/90 tracking-wide mt-0.5">{{ $gradeOrClass }}</p>
            </div>
            
            <!-- Menu Kebab Kanan Atas -->
            <button type="button" class="text-white/80 hover:text-white p-1 rounded-full hover:bg-white/10 transition-colors" title="Opsi">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
            </button>
        </div>

        <p class="relative z-10 text-xs text-white/85 mt-2 line-clamp-1">{{ $teacherName }}</p>
    </div>

    <!-- Badan Kartu Putih -->
    <div class="flex flex-1 flex-col justify-between p-4 min-h-[105px]">
        <div>
            @if($upcomingDeadline)
                <div class="flex items-start gap-2 text-xs text-[#202124] dark:text-[#E8EAED]">
                    <span class="text-[#D93025] font-semibold flex-shrink-0">Tenggat:</span>
                    <span class="line-clamp-2 text-[#5F6368] dark:text-[#9AA0A6]">{{ $upcomingDeadline }}</span>
                </div>
            @else
                <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6] italic">Tidak ada tugas mendekati tenggat</p>
            @endif

            @if($uncompletedCount > 0)
                <div class="mt-2.5">
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#D93025] bg-[#FCE8E6] dark:bg-[#3C1A17] px-2 py-0.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        {{ $uncompletedCount }} Tugas Belum Selesai
                    </span>
                </div>
            @endif
        </div>

        <!-- Tombol Pintasan Aksi (Tugas, Nilai, Chat) -->
        <div class="mt-4 pt-3 border-t border-[#DADCE0] dark:border-[#3C4043] flex items-center justify-between text-[#5F6368] dark:text-[#9AA0A6]">
            <a href="{{ $assignmentUrl }}" class="flex items-center gap-1.5 text-xs font-medium hover:text-[#1A73E8] dark:hover:text-[#8AB4F8] transition-colors p-1 rounded hover:bg-[#E8F0FE]/50 dark:hover:bg-white/5" title="Lihat Tugas">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span>Tugas</span>
            </a>

            <a href="{{ $gradeUrl }}" class="flex items-center gap-1.5 text-xs font-medium hover:text-[#1A73E8] dark:hover:text-[#8AB4F8] transition-colors p-1 rounded hover:bg-[#E8F0FE]/50 dark:hover:bg-white/5" title="Lihat Nilai">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                <span>Nilai</span>
            </a>

            <a href="{{ $chatUrl }}" class="flex items-center gap-1.5 text-xs font-medium hover:text-[#1A73E8] dark:hover:text-[#8AB4F8] transition-colors p-1 rounded hover:bg-[#E8F0FE]/50 dark:hover:bg-white/5" title="Chat Guru Mapel">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Chat</span>
            </a>
        </div>
    </div>
</div>

