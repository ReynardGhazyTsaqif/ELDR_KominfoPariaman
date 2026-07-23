<x-app-layout>
    <div class="min-h-[72vh] flex flex-col items-center justify-center text-center relative py-12 px-4">
        <!-- Center Shield Lock Illustration -->
        <div class="w-24 h-28 flex items-center justify-center relative mb-4">
            <svg class="w-24 h-28 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <svg class="w-7 h-7 text-amber-600 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>

        <!-- Heading & Description -->
        <h2 class="text-3xl font-black text-[#061D38] tracking-tight">Akses Ditolak</h2>
        <p class="text-sm font-medium text-gray-500 max-w-md mt-3 leading-relaxed">
            Anda tidak memiliki izin untuk mengakses halaman ini. Hubungi Super Admin jika ini seharusnya bisa diakses.
        </p>

        <!-- Action Button -->
        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all mt-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>

        <!-- Divider Line -->
        <div class="w-full max-w-md border-t border-gray-200/80 my-10"></div>

        <!-- Error Code Footer -->
        <span class="text-xs font-mono font-bold text-gray-400 tracking-wider">
            ERROR CODE: 403 FORBIDDEN
        </span>
    </div>
</x-app-layout>
