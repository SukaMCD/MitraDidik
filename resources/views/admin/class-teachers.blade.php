<x-layouts.app title="Penugasan Guru Mapel" activeRoute="admin.class-teachers">
    <div class="space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Penugasan Guru Mata Pelajaran & Wali Kelas</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Data penugasan ini menjadi kunci validasi agar orang tua hanya dapat berinteraksi (chat) dengan guru yang tepat.
            </p>
        </div>

        <div class="p-6 rounded-2xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs space-y-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#F8F9FA] dark:bg-[#202124] border-b border-[#DADCE0] dark:border-[#3C4043] text-[#5F6368] dark:text-[#9AA0A6]">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Rombel (Kelas)</th>
                            <th class="px-4 py-3 font-semibold">Mata Pelajaran</th>
                            <th class="px-4 py-3 font-semibold">Nama Guru</th>
                            <th class="px-4 py-3 font-semibold">Peran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DADCE0]/60 dark:divide-[#3C4043]/60">
                        @foreach($assignments as $a)
                            <tr>
                                <td class="px-4 py-3 font-bold text-[#202124] dark:text-[#E8EAED]">{{ $a->class->name ?? '-' }}</td>
                                <td class="px-4 py-3 font-medium text-[#202124] dark:text-[#E8EAED]">
                                    @if($a->subject)
                                        <span class="inline-flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $a->subject->banner_color }};"></span>
                                            {{ $a->subject->name }}
                                        </span>
                                    @else
                                        <span class="text-[#5F6368] dark:text-[#9AA0A6] italic">- Umum / Wali Kelas -</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-[#1A73E8] font-semibold">{{ $a->teacher->name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($a->is_homeroom)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            Wali Kelas
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                            Guru Mapel
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

