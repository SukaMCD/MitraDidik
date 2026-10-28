<x-layouts.app title="Relasi Siswa & Wali" activeRoute="admin.student-guardians">
    <div class="space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Pemetaan Relasi Siswa & Wali Murid</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Memastikan setiap orang tua hanya dapat melihat dan menerima pembaruan untuk anak yang terdaftar secara sah.
            </p>
        </div>

        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama Siswa</th>
                            <th class="px-4 py-3 font-semibold">NIS</th>
                            <th class="px-4 py-3 font-semibold">Kelas</th>
                            <th class="px-4 py-3 font-semibold">Nama Wali Murid</th>
                            <th class="px-4 py-3 font-semibold">Hubungan</th>
                            <th class="px-4 py-3 font-semibold">Wali Utama?</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($relations as $r)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $r->student->full_name ?? '-' }}</td>
                                <td class="px-4 py-3 font-mono text-[#5F6368] dark:text-[#9AA0A6]">{{ $r->student->nis ?? '-' }}</td>
                                <td class="px-4 py-3 font-medium text-[#202124] dark:text-[#E8EAED]">{{ $r->student->class->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-[#1A73E8] font-semibold">{{ $r->guardian->name ?? '-' }}</td>
                                <td class="px-4 py-3 uppercase text-[11px] font-bold text-[#5F6368] dark:text-[#9AA0A6]">{{ $r->relation }}</td>
                                <td class="px-4 py-3">
                                    @if($r->is_primary)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Wali Utama
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-700">
                                            Wali Tambahan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

