<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - MitraDidik</title>
    <link rel="icon" type="image/svg+xml" href="/brand/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        // Inisialisasi dark mode class seawal mungkin sebelum render
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F0F4F9] dark:bg-[#1E1F20] text-[#202124] dark:text-[#E8EAED] min-h-screen flex flex-col justify-center items-center p-4 font-sans antialiased relative overflow-hidden transition-colors duration-200">

    <!-- Latar Belakang Dekoratif Visual Gaya Classroom (Terlihat Jelas dan Elegan) -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-[#E8F0FE]/80 dark:bg-[#1A3353]/30 blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#E6F4EA]/70 dark:bg-[#13381B]/30 blur-2xl pointer-events-none"></div>
    <div class="absolute top-1/2 left-8 w-32 h-32 rounded-full border-4 border-[#1A73E8]/10 dark:border-[#8AB4F8]/10 pointer-events-none hidden lg:block"></div>
    <div class="absolute top-1/4 right-12 w-24 h-24 rounded-2xl rotate-12 border-4 border-[#F9AB00]/15 dark:border-[#FDD663]/10 pointer-events-none hidden lg:block"></div>

    <!-- Tombol Pengalih Mode Terang/Gelap di Pojok Kanan Atas -->
    <div class="absolute top-4 right-4 z-20">
        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode); document.documentElement.classList.toggle('dark', darkMode)" 
            type="button" 
            class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#2D2E31] text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] shadow-xs transition-colors"
            title="Ganti Mode Tampilan">
            <!-- Ikon Matahari (Saat Dark Mode Aktif) -->
            <svg x-show="darkMode" class="w-4 h-4 text-[#FDD663]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <!-- Ikon Bulan (Saat Light Mode Aktif) -->
            <svg x-show="!darkMode" class="w-4 h-4 text-[#5F6368]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            <span x-text="darkMode ? 'Mode Terang' : 'Mode Gelap'"></span>
        </button>
    </div>

    <!-- Kontainer Kartu Login -->
    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Header Brand -->
        <div class="text-center mb-6">
            <div class="inline-flex justify-center mb-2">
                <img src="/brand/logo-full.svg" alt="MitraDidik Logo" class="h-14 block dark:hidden" />
                <img src="/brand/logo-white.svg" alt="MitraDidik Logo" class="h-14 hidden dark:block" />
            </div>
            <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6] font-medium tracking-wide">
                Portal Kemitraan Orang Tua, Guru & Sekolah
            </p>
        </div>

        <!-- Kartu Form Login -->
        <div class="bg-white dark:bg-[#2D2E31] rounded-2xl border border-[#DADCE0] dark:border-[#3C4043] p-6 sm:p-8 shadow-md">
            <h1 class="text-xl font-bold text-[#202124] dark:text-[#E8EAED] mb-1">Masuk ke Akun</h1>
            <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6] mb-6">Gunakan email sekolah atau email terdaftar Anda</p>

            @if($errors->any())
                <div class="mb-5 p-3 rounded-xl bg-[#FCE8E6] dark:bg-[#3C1A17] text-[#D93025] dark:text-[#F28B82] border border-[#FAD2CF] dark:border-[#61241E] text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1.5">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', 'admin@mitradidik.sch.id') }}" required autofocus
                        class="w-full px-3.5 py-2.5 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:outline-none focus:ring-2 focus:ring-[#1A73E8] focus:border-transparent transition-all"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED]">Kata Sandi</label>
                        <a href="#" class="text-xs text-[#1A73E8] dark:text-[#8AB4F8] hover:underline font-medium">Lupa sandi?</a>
                    </div>
                    <input type="password" id="password" name="password" value="password123" required
                        class="w-full px-3.5 py-2.5 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:outline-none focus:ring-2 focus:ring-[#1A73E8] focus:border-transparent transition-all"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-[#DADCE0] text-[#1A73E8] focus:ring-[#1A73E8]">
                    <label for="remember" class="ml-2 text-xs text-[#5F6368] dark:text-[#9AA0A6] select-none">Ingat sesi di perangkat ini</label>
                </div>

                <button type="submit" class="w-full mt-2 py-2.5 px-4 rounded-full bg-[#1A73E8] hover:bg-[#1557B0] text-white text-sm font-semibold tracking-wide transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1A73E8]">
                    Masuk Sekarang
                </button>
            </form>

            <!-- Quick Demo Login Switcher (1-Klik untuk Evaluasi Cepat 3 Peran) -->
            <div class="mt-6 pt-5 border-t border-[#DADCE0] dark:border-[#3C4043]">
                <p class="text-[11px] font-bold text-[#5F6368] dark:text-[#9AA0A6] uppercase tracking-wider text-center mb-2.5">
                    Login Cepat Demo (1-Klik):
                </p>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="quickLogin('admin@mitradidik.sch.id', 'password123')" class="px-2 py-1.5 rounded-lg text-xs font-semibold bg-purple-50 hover:bg-purple-100 text-purple-700 dark:bg-purple-950/40 dark:text-purple-300 border border-purple-200 dark:border-purple-800 transition-colors">
                        Admin
                    </button>
                    <button type="button" onclick="quickLogin('guru.ahmad@mitradidik.sch.id', 'password123')" class="px-2 py-1.5 rounded-lg text-xs font-semibold bg-blue-50 hover:bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800 transition-colors">
                        Guru (Wali/Mapel)
                    </button>
                    <button type="button" onclick="quickLogin('ortu.adit@gmail.com', 'password123')" class="px-2 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 hover:bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 transition-colors">
                        Orang Tua
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Hak Cipta -->
        <p class="text-center text-xs text-[#5F6368] dark:text-[#9AA0A6] mt-6">
            &copy; {{ date('Y') }} MitraDidik. Hak cipta dilindungi undang-undang.
        </p>
    </div>

    <script>
        function quickLogin(email, pass) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }
    </script>
</body>
</html>
