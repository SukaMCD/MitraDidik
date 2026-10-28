<x-layouts.app title="Kelola Pengguna" activeRoute="admin.users">
    <div class="space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Manajemen Pengguna (Guru & Orang Tua)</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Kelola akun guru pendidik dan akun wali murid. Siswa tidak memiliki akun login mandiri.
            </p>
        </div>

        <!-- Tabel Akun Guru -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Akun Guru Pendidik ({{ $teachers->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama Guru</th>
                            <th class="px-4 py-3 font-semibold">NIP</th>
                            <th class="px-4 py-3 font-semibold">Email Sekolah</th>
                            <th class="px-4 py-3 font-semibold">No. Telepon</th>
                            <th class="px-4 py-3 font-semibold">Gaya Mengajar</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($teachers as $t)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $t->name }}</td>
                                <td class="px-4 py-3 font-mono text-[#5F6368] dark:text-[#9AA0A6]">{{ $t->teacherProfile->nip ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#1A73E8] font-medium">{{ $t->email }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $t->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $t->teacherProfile->teaching_style ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $t->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Akun Orang Tua -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-[#202124] dark:text-[#E8EAED]">Akun Orang Tua / Wali Murid ({{ $guardians->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama Orang Tua</th>
                            <th class="px-4 py-3 font-semibold">Email Akun</th>
                            <th class="px-4 py-3 font-semibold">No. Telepon / WhatsApp</th>
                            <th class="px-4 py-3 font-semibold">Anak yang Dipantau</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($guardians as $g)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $g->name }}</td>
                                <td class="px-4 py-3 text-[#1A73E8] font-medium">{{ $g->email }}</td>
                                <td class="px-4 py-3 text-[#5F6368] dark:text-[#9AA0A6]">{{ $g->phone ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @foreach($g->students as $st)
                                        <span class="inline-block px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-[11px] font-semibold mr-1 mb-1">
                                            {{ $st->full_name }} ({{ $st->class->name ?? '' }})
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $g->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ $g->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

