<x-layouts.app title="Showcase Komponen UI & Brand Guide" activeRoute="components.preview">
    <div class="space-y-8">
        <!-- Showcase Title -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                        Dokumen Komponen & Brand Guide UI
                    </span>
                    <h1 class="text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED] mt-2">
                        Showcase Komponen MitraDidik (Gaya Google Classroom)
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                        Sistem desain berbasis token, kartu mata pelajaran responsif, accordion tugas, dan palet warna fungsional.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="/login" class="px-4 py-2 rounded-full border border-[#DADCE0] dark:border-[#3C4043] text-xs font-semibold hover:bg-[#F1F3F4] dark:hover:bg-[#3C4043] transition-colors">
                        Buka Halaman Login
                    </a>
                </div>
            </div>
        </div>

        <!-- 1. IDENTITAS BRAND & LOGO RESMI -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                1. Logo Vektor & Filosofi Merek MitraDidik
            </h2>
            <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6] leading-relaxed">
                <strong>Filosofi Logo:</strong> Simbol segitiga dinamis geometris menggambarkan kemitraan kokoh tiga pilar: <strong>Guru (Pendidik)</strong> di puncak biru, <strong>Orang Tua (Keluarga)</strong> di sisi fondasi kiri, dan <strong>Siswa (Anak Didik)</strong> di sisi kanan hijau bertumbuh, terhubung melingkar dengan titik sinergi emas di pusatnya.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-2">
                <!-- Varian 1: Logo Lengkap (Latar Terang) -->
                <div class="p-4 rounded-xl bg-[#F8F9FA] dark:bg-[#202124] border border-[#DADCE0] dark:border-[#3C4043] text-center space-y-2">
                    <span class="text-[11px] font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Logo Lengkap (Latar Terang)</span>
                    <div class="h-16 flex items-center justify-center p-2 bg-white rounded-lg border border-gray-100 shadow-2xs">
                        <img src="/brand/logo-full.svg" alt="MitraDidik Full Logo" class="max-h-12 w-auto" />
                    </div>
                    <code class="text-[10px] text-gray-500 block">/public/brand/logo-full.svg</code>
                </div>

                <!-- Varian 2: Ikon Saja (Favicon / App Bar) -->
                <div class="p-4 rounded-xl bg-[#F8F9FA] dark:bg-[#202124] border border-[#DADCE0] dark:border-[#3C4043] text-center space-y-2">
                    <span class="text-[11px] font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Ikon Triad (Favicon / Avatar)</span>
                    <div class="h-16 flex items-center justify-center p-2 bg-white rounded-lg border border-gray-100 shadow-2xs">
                        <img src="/brand/logo-icon.svg" alt="MitraDidik Icon" class="h-12 w-12" />
                    </div>
                    <code class="text-[10px] text-gray-500 block">/public/brand/logo-icon.svg</code>
                </div>

                <!-- Varian 3: Logo Putih (Untuk Latar Gelap) -->
                <div class="p-4 rounded-xl bg-[#F8F9FA] dark:bg-[#202124] border border-[#DADCE0] dark:border-[#3C4043] text-center space-y-2">
                    <span class="text-[11px] font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Logo Putih (Latar Gelap)</span>
                    <div class="h-16 flex items-center justify-center p-2 bg-[#202124] rounded-lg border border-gray-700 shadow-2xs">
                        <img src="/brand/logo-white.svg" alt="MitraDidik White Logo" class="max-h-12 w-auto" />
                    </div>
                    <code class="text-[10px] text-gray-500 block">/public/brand/logo-white.svg</code>
                </div>

                <!-- Varian 4: Monochrome (Satu Warna) -->
                <div class="p-4 rounded-xl bg-[#F8F9FA] dark:bg-[#202124] border border-[#DADCE0] dark:border-[#3C4043] text-center space-y-2">
                    <span class="text-[11px] font-semibold text-[#5F6368] dark:text-[#9AA0A6]">Versi Monochrome (Satu Warna)</span>
                    <div class="h-16 flex items-center justify-center p-2 bg-white rounded-lg border border-gray-100 shadow-2xs">
                        <img src="/brand/logo-mono.svg" alt="MitraDidik Mono Logo" class="max-h-12 w-auto" />
                    </div>
                    <code class="text-[10px] text-gray-500 block">/public/brand/logo-mono.svg</code>
                </div>
            </div>
        </div>

        <!-- 2. DESIGN TOKENS & PALET WARNA -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                2. Design Tokens & Palet Fungsional (Sesuai Spesifikasi Gambar)
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#1A73E8] mb-2"></div>
                    <p class="text-xs font-bold">Utama (Primary)</p>
                    <code class="text-[10px] text-gray-500">#1A73E8</code>
                </div>

                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#1557B0] mb-2"></div>
                    <p class="text-xs font-bold">Utama Gelap</p>
                    <code class="text-[10px] text-gray-500">#1557B0</code>
                </div>

                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#E8F0FE] border border-blue-200 mb-2"></div>
                    <p class="text-xs font-bold text-gray-900 dark:text-gray-100">Latar Aktif/Chip</p>
                    <code class="text-[10px] text-gray-500">#E8F0FE</code>
                </div>

                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#188038] mb-2"></div>
                    <p class="text-xs font-bold">Sukses / Hadir</p>
                    <code class="text-[10px] text-gray-500">#188038</code>
                </div>

                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#F9AB00] mb-2"></div>
                    <p class="text-xs font-bold">Terlambat / SP1</p>
                    <code class="text-[10px] text-gray-500">#F9AB00</code>
                </div>

                <div class="p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#202124]">
                    <div class="w-full h-8 rounded-md bg-[#D93025] mb-2"></div>
                    <p class="text-xs font-bold">Alpa / Bahaya</p>
                    <code class="text-[10px] text-gray-500">#D93025</code>
                </div>
            </div>
        </div>

        <!-- 3. STATUS CHIPS GALLERY -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                3. Komponen StatusChip (Fungsional, Ikon + Teks, Kontras Tinggi)
            </h2>

            <div class="space-y-3">
                <div>
                    <h3 class="text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6] mb-2">Presensi Siswa:</h3>
                    <div class="flex flex-wrap gap-2">
                        <x-status-chip status="hadir" />
                        <x-status-chip status="terlambat" />
                        <x-status-chip status="izin" />
                        <x-status-chip status="sakit" />
                        <x-status-chip status="alpa" />
                    </div>
                </div>

                <div class="pt-2">
                    <h3 class="text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6] mb-2">Tugas & Nilai:</h3>
                    <div class="flex flex-wrap gap-2">
                        <x-status-chip status="sudah" />
                        <x-status-chip status="belum" />
                        <x-status-chip status="alpa" label="Terlambat Kumpul" />
                        <x-status-chip status="dinilai" />
                    </div>
                </div>

                <div class="pt-2">
                    <h3 class="text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6] mb-2">Karakter & Peringatan Demerit (100 -> 0):</h3>
                    <div class="flex flex-wrap gap-2">
                        <x-status-chip status="normal" />
                        <x-status-chip status="sp1" />
                        <x-status-chip status="sp2" />
                        <x-status-chip status="sp3" />
                        <x-status-chip status="merit" label="Poin Budi Luhur (+20)" />
                        <x-status-chip status="held" />
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. SUBJECT CARD GAYA CLASSROOM -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                4. Komponen SubjectCard (Kartu Mapel Gaya Google Classroom)
            </h2>
            <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">
                Banner warna tetap per mata pelajaran (Matematika #1A73E8, IPA #188038, B. Indonesia #C5221F, B. Inggris #8430CE, IPS #C26401) dengan aksi pintasan Tugas, Nilai, dan Chat.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <x-subject-card 
                    subjectName="Matematika"
                    teacherName="Ahmad Fauzi, S.Pd"
                    bannerColor="#1A73E8"
                    gradeOrClass="Kelas 7A"
                    upcomingDeadline="Latihan Aljabar 3 - Besok 23:59"
                    :uncompletedCount="0"
                />

                <x-subject-card 
                    subjectName="Ilmu Pengetahuan Alam"
                    teacherName="Siti Rahmawati, M.Pd"
                    bannerColor="#188038"
                    gradeOrClass="Kelas 7A"
                    upcomingDeadline="Laporan Praktikum Asam Basa - 3 Hari Lagi"
                    :uncompletedCount="1"
                />

                <x-subject-card 
                    subjectName="Bahasa Indonesia"
                    teacherName="Dewi Lestari, S.Pd"
                    bannerColor="#C5221F"
                    gradeOrClass="Kelas 7A"
                    upcomingDeadline="Teks Deskripsi Budaya - Jumat 15:00"
                    :uncompletedCount="0"
                />

                <x-subject-card 
                    subjectName="Bahasa Inggris"
                    teacherName="Budi Santoso, M.Ed"
                    bannerColor="#8430CE"
                    gradeOrClass="Kelas 7A"
                    :uncompletedCount="0"
                />
            </div>
        </div>

        <!-- 5. ASSIGNMENT ROW ACCORDION (CLASSWORK STYLE) -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                5. Komponen AssignmentRow (Accordion Tugas Gaya "Classwork")
            </h2>
            <p class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">
                Klik pada baris tugas untuk memperluas (*expand*) rincian instruksi, feedback guru, dan skor penilaian.
            </p>

            <div class="space-y-3">
                <x-assignment-row 
                    title="Latihan 3: Aljabar Linear Satu Variabel"
                    subjectName="Matematika"
                    subjectColor="#1A73E8"
                    dueDate="Besok, 23:59"
                    status="dinilai"
                    :score="95"
                    :maxPoints="100"
                    description="Kerjakan soal no 1-10 pada halaman 45. Tuliskan langkah penyelesaian secara lengkap dan teliti di lembar kerja."
                    teacherFeedback="Langkah pengerjaan sangat terstruktur dan tepat. Pertahankan ya Adit!"
                    source="google_classroom"
                    externalLink="https://classroom.google.com"
                />

                <x-assignment-row 
                    title="Laporan Praktikum: Uji Asam & Basa Rumah Tangga"
                    subjectName="IPA"
                    subjectColor="#188038"
                    dueDate="3 Hari Lagi, 17:00"
                    status="belum"
                    :maxPoints="100"
                    description="Foto hasil percobaan uji asam basa dengan kertas lakmus dan indikator kunyit. Unggah foto bersama catatan analisis."
                    source="manual"
                />

                <x-assignment-row 
                    title="Menulis Teks Deskripsi Objek Wisata Nusantara"
                    subjectName="Bahasa Indonesia"
                    subjectColor="#C5221F"
                    dueDate="Kemarin, 23:59"
                    status="alpa"
                    :maxPoints="100"
                    description="Panjang tulisan minimal 3 paragraf dengan memperhatikan kaidah PUEBI."
                    source="google_classroom"
                />
            </div>
        </div>
    </div>
</x-layouts.app>

