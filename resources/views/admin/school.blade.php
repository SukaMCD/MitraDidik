<x-layouts.app title="Pengaturan Sekolah & Jam Tenang" activeRoute="admin.school">
    <div class="max-w-4xl space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Pengaturan Sekolah & Jam Tenang</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Atur identitas lembaga, zona waktu, serta perlindungan waktu istirahat guru (Quiet Hours).
            </p>
        </div>

        <form method="POST" action="{{ route('admin.school.update') }}" class="space-y-6">
            @csrf

            <!-- Kartu Identitas Sekolah -->
            <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
                <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED] border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                    Profil Lembaga Sekolah
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Nama Sekolah</label>
                        <input type="text" name="name" value="{{ old('name', $school->name) }}" required
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Nomor Pokok Sekolah Nasional (NPSN)</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $school->npsn) }}" required
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Nomor Telepon Kantor</label>
                        <input type="text" name="phone" value="{{ old('phone', $school->phone) }}"
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Zona Waktu Operasional</label>
                        <select name="timezone" class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                            <option value="Asia/Jakarta" {{ $school->timezone == 'Asia/Jakarta' ? 'selected' : '' }}>WIB (Asia/Jakarta)</option>
                            <option value="Asia/Makassar" {{ $school->timezone == 'Asia/Makassar' ? 'selected' : '' }}>WITA (Asia/Makassar)</option>
                            <option value="Asia/Jayapura" {{ $school->timezone == 'Asia/Jayapura' ? 'selected' : '' }}>WIT (Asia/Jayapura)</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Alamat Lengkap</label>
                        <input type="text" name="address" value="{{ old('address', $school->address) }}"
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Kartu Konfigurasi Jam Tenang Guru (Quiet Hours) -->
            <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-[#DADCE0] dark:border-[#3C4043] pb-3">
                    <svg class="w-5 h-5 text-[#B06000] dark:text-[#FDD663]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">
                        Konfigurasi Jam Tenang Guru (*Quiet Hours*)
                    </h2>
                </div>

                <div class="p-4 rounded-xl bg-[#FEF7E0] dark:bg-[#3E3821] border border-[#FEEFC3] dark:border-[#5E521F] text-xs text-[#B06000] dark:text-[#FDD663] leading-relaxed">
                    <strong>Penting:</strong> Ketika Jam Tenang aktif, pesan chat dari orang tua akan otomatis disimpan dengan status <code>held</code> dan dijadwalkan terkirim pada jam dinas berikutnya (waktu akhir jam tenang). Guru tidak akan terganggu oleh notifikasi di luar jam kerja.
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Jam Mulai Jam Tenang (Malam/Sore)</label>
                        <input type="time" name="quiet_start" value="{{ old('quiet_start', substr($school->quiet_start, 0, 5)) }}" required
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                        <span class="text-[11px] text-[#5F6368] dark:text-[#9AA0A6] mt-0.5 block">Contoh: 17:00 (pesan mulai ditahan)</span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#202124] dark:text-[#E8EAED] mb-1">Jam Selesai Jam Tenang (Pagi)</label>
                        <input type="time" name="quiet_end" value="{{ old('quiet_end', substr($school->quiet_end, 0, 5)) }}" required
                            class="w-full px-3.5 py-2 rounded-lg border border-[#DADCE0] dark:border-[#3C4043] bg-white dark:bg-[#202124] text-[#202124] dark:text-[#E8EAED] text-sm focus:ring-2 focus:ring-[#1A73E8] focus:outline-none">
                        <span class="text-[11px] text-[#5F6368] dark:text-[#9AA0A6] mt-0.5 block">Contoh: 07:00 (pesan ditahan diserahkan ke guru)</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-full border border-[#DADCE0] dark:border-[#3C4043] text-xs font-semibold text-[#5F6368] dark:text-[#9AA0A6] hover:bg-[#F1F3F4] transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 rounded-full bg-[#1A73E8] hover:bg-[#1557B0] text-white text-xs font-semibold shadow-xs transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>

