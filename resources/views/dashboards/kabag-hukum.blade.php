<!-- Kabag Hukum Dashboard (Pengesahan & Approval Final) -->
<div class="space-y-6">
    <!-- 1. Top Welcome Banner for Kabag Hukum -->
    <div class="bg-gradient-to-r from-[#061D38] to-[#0A3363] text-white rounded-2xl p-7 shadow-md flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="bg-[#F5BF38] text-[#061D38] text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    Persetujuan Final
                </span>
                <span class="text-xs text-blue-200">Bagian Hukum Setda Kota Pariaman</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">
                Selamat Datang, Kepala Bagian Hukum
            </h1>
            <p class="text-xs text-blue-100 font-medium leading-relaxed mt-1 max-w-xl">
                Panel pengesahan resmi regulasi dan dokumen hukum. Peninjauan akhir dokumen yang telah lolos verifikasi telaah tim Admin Hukum.
            </p>
        </div>
        <div class="flex items-center gap-4 flex-shrink-0">
            <div class="text-center px-4 py-2 bg-white/10 rounded-xl backdrop-blur-xs border border-white/10">
                <span class="text-[10px] uppercase font-bold text-gray-300 tracking-wider block">Menunggu Pengesahan</span>
                <span class="text-2xl font-black text-[#F5BF38]">5 Dokumen</span>
            </div>
        </div>
    </div>

    <!-- 2. 3 KPI Summary Cards for Kabag Hukum -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Menunggu Pengesahan -->
        <div class="bg-white border border-amber-200 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-amber-800 uppercase tracking-wider">MENUNGGU PENGESAHAN</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">5</p>
                <p class="text-xs font-semibold text-amber-700 mt-1">✓ Lolos Telaah Tim Admin Hukum</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                </svg>
            </div>
        </div>

        <!-- Telah Disahkan Bulan Ini -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TELAH DISAHKAN BULAN INI</h4>
                <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">38</p>
                <p class="text-xs font-semibold text-gray-500 mt-1">📈 +15% dari bulan lalu</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
        </div>

        <!-- Total Diproses Bagian Hukum -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL REGULASI PROSES</h4>
                <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">43</p>
                <p class="text-xs font-semibold text-gray-500 mt-1">Tahun Anggaran 2026</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 3. Tabel Dokumen Menunggu Pengesahan Kabag Hukum -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h3 class="text-base font-extrabold text-[#061D38]">Daftar Dokumen Menunggu Pengesahan Final</h3>
            </div>
            <span class="text-xs font-bold text-gray-400">Total: 5 Dokumen</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID DOKUMEN</th>
                        <th class="py-3.5 px-6">NAMA REGULASI / DOKUMEN</th>
                        <th class="py-3.5 px-6">OPD PENGAJU</th>
                        <th class="py-3.5 px-4 text-center">STATUS TELAAH ADMIN HUKUM</th>
                        <th class="py-3.5 px-6 text-center">AKSI PENGESAHAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 text-xs text-gray-500 font-mono">DOC-2026-001</td>
                        <td class="py-4 px-6">
                            <h4 class="font-bold text-[#061D38] text-sm">Rancangan Peraturan Walikota SPBE 2026</h4>
                            <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Peraturan Walikota</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">Dinas Kominfo Pariaman</td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                ✓ Disetujui Admin Hukum
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="px-3.5 py-1.5 bg-[#061D38] hover:bg-[#0A3363] text-white font-bold rounded-xl text-xs flex items-center gap-1.5 transition-all cursor-pointer shadow-xs">
                                    <svg class="w-3.5 h-3.5 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Sahkan (Disetujui)</span>
                                </button>
                                <button type="button" class="px-3 py-1.5 bg-white border border-rose-300 hover:bg-rose-50 text-rose-600 font-bold rounded-xl text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <span>Kembalikan</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 text-xs text-gray-500 font-mono">DOC-2026-004</td>
                        <td class="py-4 px-6">
                            <h4 class="font-bold text-[#061D38] text-sm">SK Penetapan Tim Keamanan Siber Daerah</h4>
                            <span class="text-xs text-gray-400 font-medium block mt-0.5">Jenis: Keputusan Walikota</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">Setdako Pariaman</td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                ✓ Disetujui Admin Hukum
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="px-3.5 py-1.5 bg-[#061D38] hover:bg-[#0A3363] text-white font-bold rounded-xl text-xs flex items-center gap-1.5 transition-all cursor-pointer shadow-xs">
                                    <svg class="w-3.5 h-3.5 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Sahkan (Disetujui)</span>
                                </button>
                                <button type="button" class="px-3 py-1.5 bg-white border border-rose-300 hover:bg-rose-50 text-rose-600 font-bold rounded-xl text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <span>Kembalikan</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
