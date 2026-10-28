@props([
    'status' => 'hadir',
    'label' => null,
    'size' => 'md', // sm, md
])

@php
    $statusKey = strtolower($status);
    $configs = [
        'hadir' => [
            'bg' => 'bg-[#E6F4EA] dark:bg-[#13381B]',
            'text' => 'text-[#188038] dark:text-[#81C995]',
            'border' => 'border-[#CEEAD6] dark:border-[#1E5C2B]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
            'textLabel' => 'Hadir',
        ],
        'terlambat' => [
            'bg' => 'bg-[#FEF7E0] dark:bg-[#3E3821]',
            'text' => 'text-[#B06000] dark:text-[#FDD663]',
            'border' => 'border-[#FEEFC3] dark:border-[#5E521F]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'textLabel' => 'Terlambat',
        ],
        'izin' => [
            'bg' => 'bg-[#E8F0FE] dark:bg-[#1A3353]',
            'text' => 'text-[#1A73E8] dark:text-[#8AB4F8]',
            'border' => 'border-[#D2E3FC] dark:border-[#284E7E]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
            'textLabel' => 'Izin',
        ],
        'sakit' => [
            'bg' => 'bg-[#FEF0E6] dark:bg-[#3C2719]',
            'text' => 'text-[#E8710A] dark:text-[#FCAD70]',
            'border' => 'border-[#FDDAC2] dark:border-[#673E20]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>',
            'textLabel' => 'Sakit',
        ],
        'alpa' => [
            'bg' => 'bg-[#FCE8E6] dark:bg-[#3C1A17]',
            'text' => 'text-[#D93025] dark:text-[#F28B82]',
            'border' => 'border-[#FAD2CF] dark:border-[#61241E]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>',
            'textLabel' => 'Alpa',
        ],
        'sudah' => [
            'bg' => 'bg-[#E6F4EA] dark:bg-[#13381B]',
            'text' => 'text-[#188038] dark:text-[#81C995]',
            'border' => 'border-[#CEEAD6] dark:border-[#1E5C2B]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>',
            'textLabel' => 'Sudah Dikumpulkan',
        ],
        'belum' => [
            'bg' => 'bg-[#F1F3F4] dark:bg-[#303134]',
            'text' => 'text-[#5F6368] dark:text-[#9AA0A6]',
            'border' => 'border-[#DADCE0] dark:border-[#3C4043]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'textLabel' => 'Belum Selesai',
        ],
        'dinilai' => [
            'bg' => 'bg-[#E8F0FE] dark:bg-[#1A3353]',
            'text' => 'text-[#1A73E8] dark:text-[#8AB4F8]',
            'border' => 'border-[#D2E3FC] dark:border-[#284E7E]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>',
            'textLabel' => 'Dinilai',
        ],
        'merit' => [
            'bg' => 'bg-[#E6F4EA] dark:bg-[#13381B]',
            'text' => 'text-[#0B8043] dark:text-[#81C995]',
            'border' => 'border-[#CEEAD6] dark:border-[#1E5C2B]',
            'icon' => '<svg class="w-3.5 h-3.5 text-[#F9AB00]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>',
            'textLabel' => 'Budi Luhur',
        ],
        'normal' => [
            'bg' => 'bg-[#E6F4EA] dark:bg-[#13381B]',
            'text' => 'text-[#188038] dark:text-[#81C995]',
            'border' => 'border-[#CEEAD6] dark:border-[#1E5C2B]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'textLabel' => 'Disiplin Baik (Normal)',
        ],
        'sp1' => [
            'bg' => 'bg-[#FEF7E0] dark:bg-[#3E3821]',
            'text' => 'text-[#B06000] dark:text-[#FDD663]',
            'border' => 'border-[#FEEFC3] dark:border-[#5E521F]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            'textLabel' => 'Peringatan 1 (SP1)',
        ],
        'sp2' => [
            'bg' => 'bg-[#FEF0E6] dark:bg-[#3C2719]',
            'text' => 'text-[#E8710A] dark:text-[#FCAD70]',
            'border' => 'border-[#FDDAC2] dark:border-[#673E20]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            'textLabel' => 'Peringatan 2 (SP2)',
        ],
        'sp3' => [
            'bg' => 'bg-[#FCE8E6] dark:bg-[#3C1A17]',
            'text' => 'text-[#D93025] dark:text-[#F28B82]',
            'border' => 'border-[#FAD2CF] dark:border-[#61241E]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            'textLabel' => 'Peringatan Kritis (SP3)',
        ],
        'held' => [
            'bg' => 'bg-[#FEF7E0] dark:bg-[#3E3821]',
            'text' => 'text-[#B06000] dark:text-[#FDD663]',
            'border' => 'border-[#FEEFC3] dark:border-[#5E521F]',
            'icon' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            'textLabel' => 'Jam Tenang (Ditahan)',
        ],
    ];

    $cfg = $configs[$statusKey] ?? [
        'bg' => 'bg-[#F1F3F4] dark:bg-[#303134]',
        'text' => 'text-[#5F6368] dark:text-[#9AA0A6]',
        'border' => 'border-[#DADCE0] dark:border-[#3C4043]',
        'icon' => '',
        'textLabel' => ucfirst($status),
    ];

    $displayText = $label ?? $cfg['textLabel'];
    $padding = ($size === 'sm') ? 'px-2 py-0.5 text-xs' : 'px-2.5 py-1 text-xs font-medium';
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full border {{ $padding }} {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }} tracking-wide transition-colors">
    {!! $cfg['icon'] !!}
    <span>{{ $displayText }}</span>
</span>

