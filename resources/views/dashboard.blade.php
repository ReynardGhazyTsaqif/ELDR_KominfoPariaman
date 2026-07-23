<x-app-layout>
    <div class="space-y-6">
        <!-- 1. Top Row: 4 KPI Summary Cards -->
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

        <!-- 2. Rincian per Jenis Dokumen Table Card -->
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

        <!-- 3. Grid Row: Tren Pengajuan & Distribusi Dokumen -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Cols: Tren Pengajuan Dokumen -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-extrabold text-[#061D38]">Tren Pengajuan Dokumen</h3>
                            <p class="text-xs font-semibold text-gray-400 mt-0.5">Statistik bulanan tahun 2024</p>
                        </div>
                        <div class="p-1 bg-gray-100 rounded-xl flex items-center gap-1 text-xs font-bold">
                            <button type="button" class="px-3 py-1 rounded-lg text-gray-500 hover:text-gray-900 cursor-pointer transition-all">Harian</button>
                            <button type="button" class="px-3 py-1 rounded-lg bg-[#061D38] text-white shadow-xs cursor-pointer">Bulanan</button>
                        </div>
                    </div>

                    <!-- Bar Chart Visual Representation -->
                    <div class="mt-8 h-48 flex items-end justify-between gap-4 px-4 border-b border-gray-100 pb-3">
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#CBD5E1] rounded-t-lg transition-all group-hover:bg-[#94A3B8]" style="height: 45%;"></div>
                            <span class="text-xs font-bold text-gray-500">Jan</span>
                        </div>
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#CBD5E1] rounded-t-lg transition-all group-hover:bg-[#94A3B8]" style="height: 60%;"></div>
                            <span class="text-xs font-bold text-gray-500">Feb</span>
                        </div>
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#CBD5E1] rounded-t-lg transition-all group-hover:bg-[#94A3B8]" style="height: 75%;"></div>
                            <span class="text-xs font-bold text-gray-500">Mar</span>
                        </div>
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#CBD5E1] rounded-t-lg transition-all group-hover:bg-[#94A3B8]" style="height: 65%;"></div>
                            <span class="text-xs font-bold text-gray-500">Apr</span>
                        </div>
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#CBD5E1] rounded-t-lg transition-all group-hover:bg-[#94A3B8]" style="height: 85%;"></div>
                            <span class="text-xs font-bold text-gray-500">Mei</span>
                        </div>
                        <div class="w-full flex flex-col items-center gap-2 group">
                            <div class="w-full bg-[#061D38] rounded-t-lg transition-all" style="height: 92%;"></div>
                            <span class="text-xs font-extrabold text-[#061D38]">Jun</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Distribusi Dokumen -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-[#061D38]">Distribusi Dokumen</h3>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5">Berdasarkan kategori hukum</p>

                    <!-- Donut Graphic Representation -->
                    <div class="mt-6 flex justify-center items-center py-4">
                        <div class="relative w-40 h-40 rounded-2xl border-[14px] border-[#061D38] flex flex-col items-center justify-center shadow-inner">
                            <span class="text-[10px] font-extrabold text-gray-400 tracking-wider">TOTAL</span>
                            <span class="text-xl font-black text-[#061D38] tracking-tight">1.240</span>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="mt-4 space-y-2 text-xs font-bold">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#061D38]"></span>
                                <span class="text-gray-700">Perda/Perwako</span>
                            </div>
                            <span class="text-[#061D38]">45%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#F5BF38]"></span>
                                <span class="text-gray-700">SK Walikota</span>
                            </div>
                            <span class="text-[#061D38]">35%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Aktivitas Terbaru Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#061D38]">Aktivitas Terbaru</h3>
                <a href="#" class="text-xs font-bold text-[#061D38] hover:underline flex items-center gap-1">
                    Lihat Semua →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                            <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                            <th class="py-3.5 px-6">OPD / DESA</th>
                            <th class="py-3.5 px-6">TANGGAL</th>
                            <th class="py-3.5 px-4 text-center">STATUS</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-bold text-[#061D38]">Rancangan Perda Tata Ruang 2024</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">Bappeda Kota Pariaman</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">24 Jun 2024, 14:20</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-[#E2E8F0] text-[#334155] font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">PENGAJUAN</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-bold text-[#061D38]">SK Pengangkatan Tenaga Ahli</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">Setdako Pariaman</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">24 Jun 2024, 11:05</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-amber-100 text-amber-800 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">DIPROSES</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
