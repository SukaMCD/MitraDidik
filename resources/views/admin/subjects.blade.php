<x-layouts.app title="Mata Pelajaran" activeRoute="admin.subjects">
    <div class="space-y-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-[#202124] dark:text-[#E8EAED]">Mata Pelajaran & Kode Banner</h1>
            <p class="text-xs sm:text-sm text-[#5F6368] dark:text-[#9AA0A6] mt-1">
                Setiap mata pelajaran memiliki warna banner tetap untuk mempermudah identifikasi visual kartu gaya Google Classroom.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($subjects as $sub)
                <div class="p-4 rounded-xl bg-white dark:bg-[#2D2E31] border border-[#DADCE0] dark:border-[#3C4043] shadow-xs flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg shadow-xs" style="background-color: {{ $sub->banner_color }};"></div>
                        <div>
                            <h3 class="text-sm font-bold text-[#202124] dark:text-[#E8EAED]">{{ $sub->name }}</h3>
                            <span class="text-xs text-[#5F6368] dark:text-[#9AA0A6]">Kode: {{ $sub->code }}</span>
                        </div>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full font-mono font-semibold" style="color: {{ $sub->banner_color }}; background-color: {{ $sub->banner_color }}18;">
                        {{ $sub->banner_color }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>

