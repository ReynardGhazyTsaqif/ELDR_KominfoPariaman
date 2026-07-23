<x-app-layout>
    @if(Auth::user() && Auth::user()->hasRole('super_admin'))
        <!-- ==================== SUPER ADMIN DASHBOARD ==================== -->
        <div class="space-y-6">
            <!-- Top Row: 4 KPI Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Pengajuan -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full flex items-center gap-1">
                            +5% ↗
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">TOTAL PENGAJUAN</h3>
                        <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">1.240</p>
                    </div>
                </div>

                <!-- Diproses -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <span class="text-xs font-extrabold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full flex items-center gap-1">
                            -2% ↘
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">DIPROSES</h3>
                        <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">85</p>
                    </div>
                </div>

                <!-- Perlu Revisi -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span class="text-xs font-extrabold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-full flex items-center gap-1">
                            +12% ↗
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">PERLU REVISI</h3>
                        <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">42</p>
                    </div>
                </div>

                <!-- Disetujui -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full flex items-center gap-1">
                            +8% ↗
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">DISETUJUI</h3>
                        <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">1.113</p>
                    </div>
                </div>
            </div>

            <!-- Rincian per Jenis Dokumen Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-base font-extrabold text-[#061D38]">Rincian per Jenis Dokumen</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                                <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                                <th class="py-3.5 px-4 text-center">DIPROSES</th>
                                <th class="py-3.5 px-4 text-center">PERLU REVISI</th>
                                <th class="py-3.5 px-4 text-center">DISETUJUI</th>
                                <th class="py-3.5 px-6 text-center">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-bold text-[#061D38]">Perda/Perwako</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-amber-50 text-amber-700 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">45</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">12</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">501</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-gray-100 text-gray-700 font-extrabold px-3.5 py-1 rounded-full text-xs min-w-[44px]">558</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-bold text-[#061D38]">SK/Keputusan Walikota-Sekda</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-amber-50 text-amber-700 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">32</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">25</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">377</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-gray-100 text-gray-700 font-extrabold px-3.5 py-1 rounded-full text-xs min-w-[44px]">434</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-bold text-[#061D38]">Perdes/Perkades</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-amber-50 text-amber-700 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">8</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">5</span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">235</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-gray-100 text-gray-700 font-extrabold px-3.5 py-1 rounded-full text-xs min-w-[44px]">248</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <!-- ==================== ADMIN OPD / DESA DASHBOARD ==================== -->
        <div class="space-y-6">
            <!-- 1. Top Welcome Banner & Ajukan Dokumen Baru Card -->
            <div class="flex flex-col lg:flex-row items-stretch justify-between gap-6">
                <!-- Left Welcome Header -->
                <div class="flex-1 flex flex-col justify-center">
                    <h1 class="text-2xl font-extrabold text-[#061D38] tracking-tight">
                        Selamat Datang, {{ Auth::user()->name ?? 'Admin Dinas Kominfo' }}
                    </h1>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1 max-w-2xl">
                        Kelola penyusunan regulasi dan dokumen hukum Anda secara digital. Pantau status pengajuan secara real-time dari panel ini.
                    </p>
                </div>

                <!-- Right Ajukan Dokumen Baru CTA Box -->
                <div class="w-full lg:w-[320px] bg-[#062447] text-white p-5 rounded-2xl shadow-md hover:shadow-lg transition-all flex items-center justify-between cursor-pointer group">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-105 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2H7a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-white tracking-tight leading-tight">Ajukan Dokumen</h3>
                            <span class="font-bold text-base text-white tracking-tight leading-tight">Baru</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. 3 KPI Summary Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Dokumen Saya -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v1a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DOKUMEN SAYA</h4>
                        <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">12</p>
                    </div>
                </div>

                <!-- Sedang Direview -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">SEDANG DIREVIEW</h4>
                        <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">3</p>
                    </div>
                </div>

                <!-- Perlu Revisi -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PERLU REVISI</h4>
                        <p class="text-3xl font-black text-rose-600 mt-0.5 tracking-tight">1</p>
                    </div>
                </div>
            </div>

            <!-- 3. Daftar Pengajuan Terakhir Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="text-base font-extrabold text-[#061D38]">Daftar Pengajuan Terakhir</h3>
                    </div>
                    <a href="#" class="text-xs font-bold text-[#061D38] hover:underline flex items-center gap-1">
                        Lihat Semua →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                                <th class="py-3.5 px-6">ID TIKET</th>
                                <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                                <th class="py-3.5 px-6">TANGGAL KIRIM</th>
                                <th class="py-3.5 px-4 text-center">STATUS</th>
                                <th class="py-3.5 px-6 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                            <!-- Row 1: Peraturan Walikota: SPBE 2024 -->
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 text-xs text-gray-500 font-mono">ELDR-2023-089</td>
                                <td class="py-4 px-6">
                                    <h4 class="font-bold text-[#061D38] text-sm">Peraturan Walikota: SPBE 2024</h4>
                                    <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Peraturan Walikota</span>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500 font-medium">12 Okt 2023</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        SELESAI
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 2: Instruksi Kadis: Keamanan Informasi -->
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 text-xs text-gray-500 font-mono">ELDR-2023-102</td>
                                <td class="py-4 px-6">
                                    <h4 class="font-bold text-[#061D38] text-sm">Instruksi Kadis: Keamanan Informasi</h4>
                                    <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Instruksi Dinas</span>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500 font-medium">15 Okt 2023</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                        REVIEW AHLI
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 3: Draft Keputusan: Tim Teknis CCTV -->
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 text-xs text-gray-500 font-mono">ELDR-2023-115</td>
                                <td class="py-4 px-6">
                                    <h4 class="font-bold text-[#061D38] text-sm">Draft Keputusan: Tim Teknis CCTV</h4>
                                    <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Keputusan Walikota</span>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500 font-medium">18 Okt 2023</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                        <svg class="w-3 h-3 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        PERLU REVISI
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            <!-- Row 4: SOP Pelayanan Informasi Publik -->
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 text-xs text-gray-500 font-mono">ELDR-2023-118</td>
                                <td class="py-4 px-6">
                                    <h4 class="font-bold text-[#061D38] text-sm">SOP Pelayanan Informasi Publik</h4>
                                    <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Standar Operasional</span>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500 font-medium">20 Okt 2023</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        DRAFT
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 4. Bottom 2 Cards Grid: Panduan Pengajuan & Pusat Bantuan -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Panduan Pengajuan Card (Dark Navy Fill) -->
                <div class="bg-[#062447] text-white rounded-2xl p-7 relative overflow-hidden flex flex-col justify-between shadow-md">
                    <div class="relative z-10 max-w-md">
                        <h3 class="text-lg font-extrabold text-white">Panduan Pengajuan</h3>
                        <p class="text-xs text-blue-100 font-medium leading-relaxed mt-2">
                            Masih bingung dengan alur pengajuan dokumen? Pelajari langkah-langkahnya di modul panduan kami.
                        </p>
                        <button type="button" class="mt-6 bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#062447] font-bold text-xs px-5 py-2.5 rounded-xl shadow transition-all cursor-pointer">
                            Baca Selengkapnya
                        </button>
                    </div>
                    <!-- Background Book Icon Outline -->
                    <div class="absolute -right-4 -bottom-6 opacity-10 pointer-events-none">
                        <svg class="w-48 h-48 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Pusat Bantuan Card (Light Gray/Earthy Fill) -->
                <div class="bg-[#EBEFE6] text-gray-800 rounded-2xl p-7 relative overflow-hidden flex flex-col justify-between shadow-xs">
                    <div class="relative z-10 max-w-md">
                        <h3 class="text-lg font-extrabold text-[#061D38]">Pusat Bantuan</h3>
                        <p class="text-xs text-gray-600 font-medium leading-relaxed mt-2">
                            Butuh bantuan teknis terkait sistem ELDR? Tim support kami siap membantu Anda.
                        </p>
                        <button type="button" class="mt-6 bg-white border border-[#061D38] hover:bg-[#061D38] hover:text-white text-[#061D38] font-bold text-xs px-5 py-2.5 rounded-xl transition-all cursor-pointer shadow-xs">
                            Hubungi Admin
                        </button>
                    </div>
                    <!-- Background Headset Icon Outline -->
                    <div class="absolute -right-4 -bottom-6 opacity-10 pointer-events-none">
                        <svg class="w-48 h-48 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
