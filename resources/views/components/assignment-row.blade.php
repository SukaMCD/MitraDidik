@props([
    'title' => 'Tugas Matematika',
    'subjectName' => 'Matematika',
    'subjectColor' => '#1A73E8',
    'dueDate' => 'Besok, 23:59',
    'status' => 'belum', // sudah, belum, terlambat, dinilai
    'score' => null,
    'maxPoints' => 100,
    'description' => null,
    'teacherFeedback' => null,
    'source' => 'google_classroom', // google_classroom, manual
    'externalLink' => null,
    'id' => null,
])

@php
    $rowId = $id ?: 'assign_' . md5($title . $dueDate);
@endphp

<div x-data="{ expanded: false }" class="border border-[#DADCE0] dark:border-[#3C4043] rounded-xl bg-white dark:bg-[#2D2E31] overflow-hidden transition-all duration-200 hover:border-[#1A73E8]/50 dark:hover:border-[#8AB4F8]/50 shadow-sm">
    <!-- Header Row (Klik untuk Expand) -->
    <div @click="expanded = !expanded" class="flex items-center justify-between p-3.5 sm:p-4 cursor-pointer select-none">
        <div class="flex items-center gap-3 min-w-0 pr-3">
            <!-- Ikon Bulat Mapel -->
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white flex-shrink-0 shadow-xs" style="background-color: {{ $subjectColor }};">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <!-- Judul & Mapel -->
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h4 class="text-sm font-semibold text-[#202124] dark:text-[#E8EAED] truncate">{{ $title }}</h4>
                    @if($source === 'google_classroom')
                        <span class="inline-flex items-center gap-0.5 text-[10px] font-medium bg-[#E8F0FE] text-[#1A73E8] dark:bg-[#1A3353] dark:text-[#8AB4F8] px-1.5 py-0.2 rounded" title="Disinkronkan dari Google Classroom">
                            <svg class="w-2.5 h-2.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
                            Classroom
                        </span>
                    @endif
                </div>
                <div class="flex items-center gap-2 mt-0.5 text-xs text-[#5F6368] dark:text-[#9AA0A6]">
                    <span class="font-medium" style="color: {{ $subjectColor }};">{{ $subjectName }}</span>
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tenggat: {{ $dueDate }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Status Chip & Chevron -->
        <div class="flex items-center gap-3 flex-shrink-0">
            @if($score !== null)
                <span class="text-xs font-bold text-[#188038] dark:text-[#81C995] bg-[#E6F4EA] dark:bg-[#13381B] px-2 py-0.5 rounded-full border border-[#CEEAD6] dark:border-[#1E5C2B]">
                    {{ $score }} / {{ $maxPoints }}
                </span>
            @endif

            <x-status-chip :status="$status" size="sm" />

            <div class="text-[#5F6368] dark:text-[#9AA0A6] transition-transform duration-200" :class="{ 'rotate-180': expanded }">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Accordion Body (Detail Instruksi & Catatan Guru) -->
    <div x-show="expanded" x-collapse x-cloak class="border-t border-[#DADCE0] dark:border-[#3C4043] p-4 bg-[#F8F9FA]/60 dark:bg-[#202124]/40">
        <div class="space-y-3 text-xs sm:text-sm">
            @if($description)
                <div>
                    <h5 class="font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Instruksi Tugas:</h5>
                    <p class="text-[#5F6368] dark:text-[#9AA0A6] whitespace-pre-line leading-relaxed">{{ $description }}</p>
                </div>
            @endif

            @if($teacherFeedback)
                <div class="p-3 rounded-lg bg-[#E8F0FE] dark:bg-[#1A3353] border border-[#D2E3FC] dark:border-[#284E7E]">
                    <div class="flex items-center gap-1.5 text-xs font-bold text-[#1A73E8] dark:text-[#8AB4F8] mb-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                        Catatan & Evaluasi Guru:
                    </div>
                    <p class="text-xs text-[#202124] dark:text-[#E8EAED]">{{ $teacherFeedback }}</p>
                </div>
            @endif

            <div class="flex flex-wrap items-center justify-between gap-2 pt-2 text-xs">
                <span class="text-[#5F6368] dark:text-[#9AA0A6]">Bobot Maksimal: <strong>{{ $maxPoints }} Poin</strong></span>

                @if($externalLink)
                    <a href="{{ $externalLink }}" target="_blank" class="inline-flex items-center gap-1 text-[#1A73E8] dark:text-[#8AB4F8] font-semibold hover:underline">
                        <span>Buka di Google Classroom</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

