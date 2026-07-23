<x-app-layout>
    <div class="min-h-[72vh] flex flex-col items-center justify-center text-center relative overflow-hidden py-12 px-4">
        <!-- Center Icon Illustration -->
        <div class="w-20 h-24 border-2 border-[#061D38] rounded-2xl flex items-center justify-center relative mb-6 shadow-xs bg-white">
            <svg class="w-9 h-9 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <!-- Heading & Description -->
        <h2 class="text-3xl font-black text-[#061D38] tracking-tight">Halaman Tidak Ditemukan</h2>
        <p class="text-sm font-medium text-gray-500 max-w-md mt-3 leading-relaxed">
            Halaman yang Anda cari tidak tersedia atau telah dipindahkan ke direktori lain dalam sistem ELDR.
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>

            <button onclick="window.history.back()" type="button" class="px-6 py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer">
                Halaman Sebelumnya
            </button>
        </div>

        <!-- Divider Line -->
        <div class="w-full max-w-lg border-t border-gray-200/80 my-10"></div>

        <!-- Bottom Assistance Links -->
        <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 text-xs font-bold text-gray-500">
            <a href="#" class="flex items-center gap-2 hover:text-[#061D38] transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Pusat Bantuan</span>
            </a>

            <a href="#" class="flex items-center gap-2 hover:text-[#061D38] transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Laporkan Bug</span>
            </a>

            <a href="#" class="flex items-center gap-2 hover:text-[#061D38] transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>
                <span>Status Sistem</span>
            </a>
        </div>

        <!-- 404 Watermark BG -->
        <div class="absolute right-4 bottom-2 text-8xl sm:text-9xl font-black text-gray-200/50 pointer-events-none select-none tracking-tighter">
            404
        </div>
    </div>
</x-app-layout>
