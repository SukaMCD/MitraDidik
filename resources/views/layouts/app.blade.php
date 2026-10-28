<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: true }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'MitraDidik' }} - Portal Kolaborasi Orang Tua & Guru</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/brand/favicon.svg">

    <!-- Fonts: Inter & Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js via CDN for responsive interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS & Vite Assets -->
    @vite(['resources/css/app.css'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8F9FA] dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] min-h-screen flex flex-col font-sans transition-colors antialiased">
    <!-- Top App Bar -->
    <x-app-bar :activeStudent="$activeStudent ?? null" :guardiansStudents="$guardiansStudents ?? []" />

    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar Drawer -->
        <x-drawer :activeRoute="$activeRoute ?? ''" />

        <!-- Main Content Area (Max 1200px di Tengah) -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 pb-20 md:pb-8">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Flash Notification Banner -->
                @if(session('success'))
                    <div class="flex items-center gap-2.5 p-3.5 rounded-xl bg-[#E6F4EA] dark:bg-[#13381B] text-[#188038] dark:text-[#81C995] border border-[#CEEAD6] dark:border-[#1E5C2B] text-xs sm:text-sm font-semibold shadow-xs">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="flex items-center gap-2.5 p-3.5 rounded-xl bg-[#FCE8E6] dark:bg-[#3C1A17] text-[#D93025] dark:text-[#F28B82] border border-[#FAD2CF] dark:border-[#61241E] text-xs sm:text-sm font-semibold shadow-xs">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Page Slot -->
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>

