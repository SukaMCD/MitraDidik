@props([
    'activeRoute' => '',
])

@php
    $user = auth()->user();
    $role = $user ? $user->role : 'guardian';

    $adminMenus = [
        ['name' => 'Dasbor Utama', 'route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['name' => 'Sekolah & Jam Tenang', 'route' => 'admin.school', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['name' => 'Tahun Ajaran & Kelas', 'route' => 'admin.classes', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['name' => 'Mata Pelajaran', 'route' => 'admin.subjects', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['name' => 'Penugasan Guru Mapel', 'route' => 'admin.class-teachers', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
        ['name' => 'Pengguna (Guru & Wali)', 'route' => 'admin.users', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
        ['name' => 'Relasi Siswa & Wali', 'route' => 'admin.student-guardians', 'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
        ['name' => 'Audit Log & Moderasi', 'route' => 'admin.audit-logs', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
    ];

    $teacherMenus = [
        ['name' => 'Dasbor Kelas', 'route' => 'teacher.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['name' => 'Presensi Harian', 'route' => 'teacher.attendance', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['name' => 'Verifikasi Izin', 'route' => 'teacher.leave-requests', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['name' => 'Tugas & Google Classroom', 'route' => 'teacher.assignments', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['name' => 'Nilai Siswa', 'route' => 'teacher.grades', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z'],
        ['name' => 'Budi Luhur & Demerit', 'route' => 'teacher.behavior', 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
        ['name' => 'Chat Orang Tua', 'route' => 'teacher.chat', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
    ];

    $guardianMenus = [
        ['name' => 'Beranda Anak', 'route' => 'guardian.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['name' => 'Kehadiran & Kalender', 'route' => 'guardian.attendance', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['name' => 'Ajukan Izin / Sakit', 'route' => 'guardian.leave-request', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['name' => 'Tugas & Deadline', 'route' => 'guardian.assignments', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
        ['name' => 'Nilai Tugas', 'route' => 'guardian.grades', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z'],
        ['name' => 'Buku Saku Karakter', 'route' => 'guardian.behavior', 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
        ['name' => 'Chat Guru Mapel', 'route' => 'guardian.chat', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
    ];

    $menus = ($role === 'admin') ? $adminMenus : (($role === 'teacher') ? $teacherMenus : $guardianMenus);
@endphp

<!-- Desktop Sidebar Drawer (Lebar 280px) -->
<aside class="hidden md:flex flex-col flex-shrink-0 transition-all duration-300 ease-in-out border-r border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] z-20" :class="sidebarOpen ? 'w-72' : 'w-18'">
    <div class="flex-1 py-4 pr-3 overflow-y-auto space-y-1">
        <div class="px-5 py-2 text-[11px] font-bold text-[#5F6368] dark:text-[#9AA0A6] uppercase tracking-wider transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 h-0 overflow-hidden'">
            Menu Utama
        </div>

        @foreach($menus as $item)
            @php
                $isActive = request()->routeIs($item['route']) || (isset($activeRoute) && $activeRoute === $item['route']);
            @endphp
            <a href="{{ route($item['route'], [], false) ?: '#' }}" class="flex items-center gap-3.5 px-4 py-2.5 rounded-r-full text-xs font-semibold transition-all duration-150 {{ $isActive ? 'bg-[#E8F0FE] text-[#1A73E8] dark:bg-[#1A3353] dark:text-[#8AB4F8] font-bold shadow-xs' : 'text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] hover:text-[#202124] dark:hover:text-[#E8EAED]' }}" title="{{ $item['name'] }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                </svg>
                <span class="truncate transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 hidden'">{{ $item['name'] }}</span>
            </a>
        @endforeach

        <div class="pt-4 mt-4 border-t border-[#DADCE0] dark:border-[#3C4043]">
            <a href="/components-preview" class="flex items-center gap-3.5 px-4 py-2.5 rounded-r-full text-xs font-semibold text-[#188038] hover:bg-[#E6F4EA] dark:hover:bg-[#13381B] transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                <span :class="sidebarOpen ? 'opacity-100' : 'opacity-0 hidden'">Showcase UI</span>
            </a>
        </div>
    </div>
</aside>

<!-- Mobile Bottom Navigation (Maksimal 5 Item Utama) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white dark:bg-[#2D2E31] border-t border-[#DADCE0] dark:border-[#3C4043] flex items-center justify-around py-1.5 px-2 shadow-lg">
    @php
        $mobileMenus = array_slice($menus, 0, 5);
    @endphp
    @foreach($mobileMenus as $item)
        @php
            $isActive = request()->routeIs($item['route']) || (isset($activeRoute) && $activeRoute === $item['route']);
        @endphp
        <a href="{{ route($item['route'], [], false) ?: '#' }}" class="flex flex-col items-center gap-0.5 py-1 px-2 rounded-lg text-[10px] font-medium transition-colors {{ $isActive ? 'text-[#1A73E8] dark:text-[#8AB4F8] font-bold' : 'text-[#5F6368] dark:text-[#9AA0A6]' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
            </svg>
            <span class="truncate max-w-[64px]">{{ $item['name'] }}</span>
        </a>
    @endforeach
</nav>

