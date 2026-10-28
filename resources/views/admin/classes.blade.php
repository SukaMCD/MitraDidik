<x-layouts.app title="Tahun Ajaran & Kelas" activeRoute="admin.classes">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Tahun Ajaran & Rombongan Belajar (Kelas)</h1>
                <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                    Kelola struktur semester aktif dan rombongan belajar peserta didik.
                </p>
            </div>
        </div>

        <!-- Tabel Tahun Ajaran -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Tahun Ajaran</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama Tahun Ajaran</th>
                            <th class="px-4 py-3 font-semibold">Tanggal Mulai</th>
                            <th class="px-4 py-3 font-semibold">Tanggal Selesai</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($academicYears as $ay)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $ay->name }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $ay->start_date->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $ay->end_date->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $ay->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $ay->is_active ? 'Aktif' : 'Arsip' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Kelas -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Daftar Rombongan Belajar (Kelas)</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama Kelas</th>
                            <th class="px-4 py-3 font-semibold">Tingkatan</th>
                            <th class="px-4 py-3 font-semibold">Wali Kelas</th>
                            <th class="px-4 py-3 font-semibold">Jumlah Siswa</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($classes as $c)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $c->name }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">Kelas {{ $c->grade_level }}</td>
                                <td class="px-4 py-3 text-[#1A73E8] font-medium">{{ $c->homeroomTeacher ? $c->homeroomTeacher->teacher->name : 'Belum Ditugaskan' }}</td>
                                <td class="px-4 py-3 font-semibold text-[#202124] dark:text-[#E8EAED]">{{ $c->students->count() }} Orang</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.class-teachers') }}" class="text-[#1A73E8] hover:underline font-semibold">Atur Guru Mapel</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

