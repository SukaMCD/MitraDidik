@props([
    'activeStudent' => null,
    'guardiansStudents' => [],
])

@php
    $user = auth()->user();
    $unreadNotifications = $user ? $user->notifications()->where('is_read', false)->count() : 0;
@endphp

<header class="sticky top-0 z-30 h-16 w-full border-b border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] px-4 sm:px-6 transition-colors shadow-xs">
    <div class="h-full flex items-center justify-between max-w-7xl mx-auto">
        <!-- Sisi Kiri: Hamburger + Brand -->
        <div class="flex items-center gap-3 sm:gap-4">
            <button @click="sidebarOpen = !sidebarOpen" type="button" class="p-2 -ml-2 rounded-full text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] hover:text-[#202124] dark:hover:text-white transition-colors" title="Buka/Tutup Navigasi">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-2.5 focus:outline-none">
                <img src="/brand/logo-icon.svg" alt="MitraDidik Logo" class="w-7 h-7 sm:w-8 sm:h-8" />
                <span class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">
                    Mitra<span class="text-[#1A73E8] dark:text-[#8AB4F8]">Didik</span>
                </span>
            </a>
        </div>

        <!-- Sisi Kanan: Pemilih Anak (Orang Tua), Notifikasi, Avatar Akun -->
        <div class="flex items-center gap-2 sm:gap-4">
            <!-- Pemilih Anak Khusus Guardian (Jika Orang Tua memiliki lebih dari 1 anak) -->
            @if($user && $user->isGuardian() && count($guardiansStudents) > 0)
                <div x-data="{ childDropdown: false }" class="relative">
                    <button @click="childDropdown = !childDropdown" type="button" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-[#DADCE0] dark:border-[#3C4043] bg-[#F8F9FA] dark:bg-[#202124] hover:bg-[#E8F0FE] dark:hover:bg-[#1A3353] text-xs font-semibold text-[#202124] dark:text-[#E8EAED] transition-colors shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-[#188038]"></span>
                        <span class="truncate max-w-[120px] sm:max-w-[160px]">{{ $activeStudent ? $activeStudent->full_name : 'Pilih Anak' }}</span>
                        <svg class="w-3.5 h-3.5 text-[#5F6368] dark:text-[#9AA0A6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="childDropdown" @click.outside="childDropdown = false" x-transition x-cloak class="absolute right-0 mt-2 w-56 rounded-xl border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] py-1 shadow-lg z-50">
                        <div class="px-3 py-2 text-[11px] font-semibold text-[#5F6368] dark:text-[#9AA0A6] uppercase tracking-wider border-b border-[#DADCE0] dark:border-[#3C4043]">
                            Pilih Siswa yang Dipantau
                        </div>
                        @foreach($guardiansStudents as $st)
                            <a href="?student_id={{ $st->id }}" class="flex items-center justify-between px-3 py-2 text-xs text-[#202124] dark:text-[#E8EAED] hover:bg-[#E8F0FE] dark:hover:bg-[#1A3353] {{ $activeStudent && $activeStudent->id === $st->id ? 'bg-[#E8F0FE]/70 font-bold text-[#1A73E8]' : '' }}">
                                <span class="truncate">{{ $st->full_name }}</span>
                                <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">{{ $st->class->name ?? '' }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" type="button" class="p-2 rounded-full text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] transition-colors" title="Ubah Mode Gelap/Terang">
                <!-- Sun Icon -->
                <svg x-show="darkMode" class="w-5 h-5 text-[#FDD663]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <!-- Moon Icon -->
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>

            <!-- Ikon Notifikasi -->
            <div x-data="{ notifDropdown: false }" class="relative">
                <button @click="notifDropdown = !notifDropdown" type="button" class="relative p-2 rounded-full text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] transition-colors" title="Notifikasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if($unreadNotifications > 0)
                        <span class="absolute top-1 right-1 w-4 h-4 bg-[#D93025] text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                            {{ $unreadNotifications }}
                        </span>
                    @endif
                </button>

                <div x-show="notifDropdown" @click.outside="notifDropdown = false" x-transition x-cloak class="absolute right-0 mt-2 w-72 sm:w-80 rounded-xl border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] py-2 shadow-xl z-50">
                    <div class="px-4 py-2 border-b border-[#DADCE0] dark:border-[#3C4043] flex items-center justify-between">
                        <span class="text-xs font-bold text-[#202124] dark:text-[#E8EAED]">Notifikasi</span>
                        <span class="text-[11px] text-[#1A73E8] dark:text-[#8AB4F8] hover:underline cursor-pointer">Tandai dibaca</span>
                    </div>
                    <div class="max-h-60 overflow-y-auto divide-y divide-[#DADCE0]/50 dark:divide-[#3C4043]/50">
                        <div class="p-3 hover:bg-[#F8F9FA] dark:hover:bg-[#202124] text-xs">
                            <p class="font-semibold text-[#202124] dark:text-[#E8EAED]">Nilai Tugas Baru</p>
                            <p class="text-[#5F6368] dark:text-[#9AA0A6] mt-0.5">Tugas Matematika Bab 3 telah dinilai: 95/100</p>
                            <span class="text-[10px] text-[#5F6368] dark:text-[#9AA0A6]">2 jam lalu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avatar & Profil Akun Dropdown -->
            <div x-data="{ profileDropdown: false }" class="relative">
                <button @click="profileDropdown = !profileDropdown" type="button" class="flex items-center gap-2 p-1 rounded-full hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] transition-colors focus:outline-none" title="Akun">
                    <div class="w-8 h-8 rounded-full bg-[#1A73E8] text-white font-bold flex items-center justify-center text-xs shadow-xs">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="hidden md:inline-block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] max-w-[120px] truncate">
                        {{ $user->name ?? 'Pengguna' }}
                    </span>
                    <svg class="hidden md:inline-block w-3.5 h-3.5 text-[#5F6368] dark:text-[#9AA0A6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="profileDropdown" @click.outside="profileDropdown = false" x-transition x-cloak class="absolute right-0 mt-2 w-56 rounded-xl border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] py-2 shadow-xl z-50">
                    <div class="px-4 py-2 border-b border-[#DADCE0] dark:border-[#3C4043]">
                        <p class="text-xs font-bold text-[#202124] dark:text-[#E8EAED] truncate">{{ $user->name ?? '' }}</p>
                        <p class="text-[11px] text-[#5F6368] dark:text-[#9AA0A6] truncate">{{ $user->email ?? '' }}</p>
                        <span class="mt-1.5 inline-block text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'teacher' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                            {{ $user->role === 'admin' ? 'Admin Sekolah' : ($user->role === 'teacher' ? 'Guru' : 'Orang Tua / Wali') }}
                        </span>
                    </div>

                    <div class="py-1">
                        <a href="/components-preview" class="flex items-center gap-2 px-4 py-2 text-xs text-[#202124] dark:text-[#E8EAED] hover:bg-[#F8F9FA] dark:hover:bg-[#202124]">
                            <svg class="w-4 h-4 text-[#1A73E8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Showcase Komponen UI</span>
                        </a>
                    </div>

                    <div class="border-t border-[#DADCE0] dark:border-[#3C4043] pt-1">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs text-[#D93025] hover:bg-[#FCE8E6] dark:hover:bg-[#3C1A17] font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span>Keluar Akun</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

