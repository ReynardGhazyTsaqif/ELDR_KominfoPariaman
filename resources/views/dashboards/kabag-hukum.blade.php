<!-- Kabag Hukum Dashboard (Final Approval & Executive Review) -->
<div class="space-y-6">
    <!-- 1. Top Row: 3 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Menunggu Persetujuan Final -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-amber-400">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU PERSETUJUAN FINAL</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">12</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-amber-50/50 text-xs font-semibold text-amber-700 flex items-center gap-1.5 border-t border-amber-100/50">
                <span>🛡️ Dari Admin Hukum</span>
            </div>
        </div>

        <!-- Card 2: Disetujui Final Bulan Ini -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-emerald-500">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI FINAL BULAN INI</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">48</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-emerald-50/50 text-xs font-semibold text-emerald-700 flex items-center gap-1.5 border-t border-emerald-100/50">
                <span>📈 +12% dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 3: Diminta Revisi Bulan Ini -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-rose-500">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIMINTA REVISI BULAN INI</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">07</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-rose-50/50 text-xs font-semibold text-rose-700 flex items-center gap-1.5 border-t border-rose-100/50">
                <span>⏰ Membutuhkan atensi segera</span>
            </div>
        </div>
    </div>

    <!-- 2. Antrian Prioritas (Perlu Tindakan) Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="text-amber-500 font-black text-lg">!</span>
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Prioritas (Perlu Tindakan)</h3>
            </div>
            <span class="bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-full text-xs">
                12 Dokumen Menunggu
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="py-3.5 px-6">URUTAN</th>
                        <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                        <th class="py-3.5 px-6">OPD/DESA PENGIRIM</th>
                        <th class="py-3.5 px-6 text-center">DURASI MENUNGGU</th>
                        <th class="py-3.5 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    <!-- Row 1: Perda Pengelolaan Sampah Regional -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 font-black text-[#061D38]">
                            01
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('documents.show') }}" class="font-bold text-[#061D38] hover:underline text-sm block">Perda Pengelolaan Sampah Regional</a>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[11px] text-gray-400 font-mono">ID-2024-081</span>
                                <span class="bg-emerald-50 text-emerald-700 font-extrabold px-2 py-0.5 rounded text-[10px]">● Disetujui Admin Hukum</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            Dinas Lingkungan Hidup
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 font-bold px-3 py-1 rounded-lg text-xs">
                                ⏰ 3 Hari
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('documents.revision') }}" class="px-3.5 py-1.5 bg-white border border-amber-500 text-amber-600 hover:bg-amber-50 font-bold rounded-lg text-xs transition-all cursor-pointer">
                                    Revisi
                                </a>
                                <a href="{{ route('documents.show') }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all cursor-pointer">
                                    Setuju
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: SK Walikota Pengangkatan ASN -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 font-black text-[#061D38]">
                            02
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('documents.show') }}" class="font-bold text-[#061D38] hover:underline text-sm block">SK Walikota Pengangkatan ASN</a>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[11px] text-gray-400 font-mono">ID-2024-092</span>
                                <span class="bg-emerald-50 text-emerald-700 font-extrabold px-2 py-0.5 rounded text-[10px]">● Disetujui Admin Hukum</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            BKPSDM
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 font-bold px-3 py-1 rounded-lg text-xs">
                                🕒 1 Hari
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('documents.revision') }}" class="px-3.5 py-1.5 bg-white border border-amber-500 text-amber-600 hover:bg-amber-50 font-bold rounded-lg text-xs transition-all cursor-pointer">
                                    Revisi
                                </a>
                                <a href="{{ route('documents.show') }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all cursor-pointer">
                                    Setuju
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50/60 border-t border-gray-100 text-center text-xs font-bold">
            <a href="{{ route('documents.index') }}" class="text-[#061D38] hover:underline">
                Lihat Semua Antrian Review
            </a>
        </div>
    </div>

    <!-- 3. Bottom Grid: Rincian per Jenis Dokumen (2/3) & Right Sidebars (1/3) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2 Cols: Rincian per Jenis Dokumen Table -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-base font-extrabold text-[#061D38]">Rincian per Jenis Dokumen</h3>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">JENIS DOKUMEN</th>
                            <th class="py-3 px-4 text-center">MENUNGGU</th>
                            <th class="py-3 px-4 text-center">REVISI</th>
                            <th class="py-3 px-4 text-center">DISETUJUI</th>
                            <th class="py-3 px-4 text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs font-semibold text-gray-700">
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3.5 px-4 font-bold text-gray-900">Perda / Perwako</td>
                            <td class="py-3.5 px-4 text-center font-bold text-amber-600">05</td>
                            <td class="py-3.5 px-4 text-center font-bold text-orange-600">02</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-600">12</td>
                            <td class="py-3.5 px-4 text-center font-black text-gray-900">19</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3.5 px-4 font-bold text-gray-900">SK / Keputusan Walikota-Sekda</td>
                            <td class="py-3.5 px-4 text-center font-bold text-amber-600">04</td>
                            <td class="py-3.5 px-4 text-center font-bold text-orange-600">03</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-600">28</td>
                            <td class="py-3.5 px-4 text-center font-black text-gray-900">35</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3.5 px-4 font-bold text-gray-900">Perdes / Perkades</td>
                            <td class="py-3.5 px-4 text-center font-bold text-amber-600">03</td>
                            <td class="py-3.5 px-4 text-center font-bold text-orange-600">02</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-600">08</td>
                            <td class="py-3.5 px-4 text-center font-black text-gray-900">13</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right 1 Col: Kinerja Review & Aktivitas Terbaru -->
        <div class="space-y-6">
            <!-- Kinerja Review Minggu Ini Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 space-y-4">
                <h4 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">KINERJA REVIEW MINGGU INI</h4>
                <div class="space-y-4 pt-1">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="font-medium text-gray-500">Rata-rata Waktu Review Final</span>
                            <span class="font-extrabold text-gray-900 text-sm">1.2 Hari</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-amber-500 h-2 rounded-full w-3/4"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="font-medium text-gray-500">Dokumen Diselesaikan Final</span>
                            <span class="font-extrabold text-gray-900 text-sm">48</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-[#062447] h-2 rounded-full w-4/5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terbaru Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 space-y-4">
                <h4 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">AKTIVITAS TERBARU</h4>
                <div class="space-y-4 pt-1 text-xs">
                    <!-- Activity 1 -->
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-[10px]">
                            ✓
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">Menyetujui Perda Lingkungan</h5>
                            <span class="text-[10px] text-gray-400 font-medium">15 Menit yang lalu</span>
                        </div>
                    </div>

                    <!-- Activity 2 -->
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-[10px]">
                            ↶
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">Mengembalikan SK Pegawai untuk revisi</h5>
                            <span class="text-[10px] text-gray-400 font-medium">2 Jam yang lalu</span>
                        </div>
                    </div>

                    <!-- Activity 3 -->
                    <div class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-[10px]">
                            👁️
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-900">Melihat dokumen Perdes Pariaman Baru</h5>
                            <span class="text-[10px] text-gray-400 font-medium">3 Jam yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
