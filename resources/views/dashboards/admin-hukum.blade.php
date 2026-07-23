<!-- Admin Hukum & Internal Reviewer Dashboard -->
<div class="space-y-6">
    <!-- 1. Top Row: 3 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Menunggu Tindak Lanjut -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU TINDAK LANJUT</h4>
                <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">24</p>
                <p class="text-xs font-bold text-amber-600 mt-1">
                    8 Prioritas Tinggi
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 022 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Disetujui Bulan Ini -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI BULAN INI</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">112</p>
                <p class="text-xs font-bold text-emerald-600 mt-1 flex items-center gap-1">
                    <span>↑ 12% dari bulan lalu</span>
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: Diminta Revisi Bulan Ini -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIMINTA REVISI BULAN INI</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">48</p>
                <p class="text-xs font-bold text-orange-600 mt-1">
                    Rata-rata 2x per dokumen
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. Antrian Prioritas (Perlu Tindakan) Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <span class="text-rose-600 font-black text-lg">!</span>
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Prioritas (Perlu Tindakan)</h3>
            </div>
            <div class="flex items-center gap-2.5">
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl text-gray-700 font-bold text-xs transition-all cursor-pointer">
                    Filter
                </button>
                <button type="button" class="px-4 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-sm transition-all cursor-pointer">
                    Ekspor Rekap
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="py-3.5 px-6">URUTAN</th>
                        <th class="py-3.5 px-6">NAMA DOKUMEN (+ID)</th>
                        <th class="py-3.5 px-6">OPD/DESA PENGIRIM</th>
                        <th class="py-3.5 px-6 text-center">DURASI MENUNGGU</th>
                        <th class="py-3.5 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    <!-- Row 1: Rancangan Perda Tata Ruang Wilayah -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 font-black text-[#061D38]">
                            #1
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('documents.show') }}" class="font-bold text-[#061D38] hover:underline text-sm block">Rancangan Perda Tata Ruang Wilayah</a>
                            <span class="text-[11px] text-gray-400 font-medium block mt-0.5">REG-2026-X001 • Perda</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            Dinas Pekerjaan Umum & Penataan Ruang
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-rose-50 text-rose-700 font-bold px-3 py-1 rounded-lg text-xs">
                                🕒 4 hari
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('documents.show') }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all cursor-pointer">
                                    Review
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: SK Walikota Panitia HUT Pariaman -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 font-black text-[#061D38]">
                            #2
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('documents.show') }}" class="font-bold text-[#061D38] hover:underline text-sm block">SK Walikota Panitia HUT Pariaman</a>
                            <span class="text-[11px] text-gray-400 font-medium block mt-0.5">REG-2026-SK042 • SK</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            Sekretariat Daerah
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 font-bold px-3 py-1 rounded-lg text-xs">
                                🕒 2 hari
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('documents.show') }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all cursor-pointer">
                                    Review
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Perdes Anggaran Desa Naras -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6 font-black text-[#061D38]">
                            #3
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('documents.show') }}" class="font-bold text-[#061D38] hover:underline text-sm block">Perdes Anggaran Desa Naras</a>
                            <span class="text-[11px] text-gray-400 font-medium block mt-0.5">REG-2026-PD009 • Perdes</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs">
                            Kantor Desa Naras I
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 font-bold px-3 py-1 rounded-lg text-xs">
                                🕒 18 jam
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('documents.show') }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all cursor-pointer">
                                    Review
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50/60 border-t border-gray-100 text-center text-xs font-bold">
            <a href="{{ route('documents.index') }}" class="text-[#061D38] hover:underline">
                Lihat Seluruh Antrian (14 Dokumen Lainnya)
            </a>
        </div>
    </div>

    <!-- 3. Rincian per Jenis Dokumen Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
        <div class="flex items-center gap-2.5 border-b border-gray-100 pb-4">
            <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 30a1 1 0 000 2h2a1 1 0 100-2h-2zM4 12a8 8 0 018-8v8H4z" />
            </svg>
            <h3 class="text-base font-extrabold text-[#061D38]">Rincian per Jenis Dokumen</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <!-- Item 1: PERDA / PERWAKO -->
            <div class="border-r border-gray-100 last:border-0 pr-6">
                <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider block">PERDA / PERWAKO</span>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-black text-gray-900">12</span>
                    <span class="text-xs font-extrabold text-rose-600">4 Mendesak</span>
                </div>
                <span class="text-[11px] font-medium text-gray-400 block mt-0.5">Dokumen Aktif</span>
                <div class="w-full bg-gray-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-rose-500 h-1.5 rounded-full w-2/3"></div>
                </div>
            </div>

            <!-- Item 2: SURAT KEPUTUSAN (SK) -->
            <div class="border-r border-gray-100 last:border-0 pr-6">
                <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider block">SURAT KEPUTUSAN (SK)</span>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-black text-gray-900">38</span>
                    <span class="text-xs font-extrabold text-amber-600">12 Review</span>
                </div>
                <span class="text-[11px] font-medium text-gray-400 block mt-0.5">Dokumen Aktif</span>
                <div class="w-full bg-gray-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-amber-500 h-1.5 rounded-full w-1/2"></div>
                </div>
            </div>

            <!-- Item 3: PERATURAN DESA -->
            <div>
                <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider block">PERATURAN DESA</span>
                <div class="flex items-baseline justify-between mt-2">
                    <span class="text-3xl font-black text-gray-900">09</span>
                    <span class="text-xs font-extrabold text-emerald-600">Selesai 2</span>
                </div>
                <span class="text-[11px] font-medium text-gray-400 block mt-0.5">Dokumen Aktif</span>
                <div class="w-full bg-gray-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-emerald-500 h-1.5 rounded-full w-4/5"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Bottom 2 Columns Grid: Aktivitas Terbaru & Kinerja Review Minggu Ini -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left: Aktivitas Terbaru Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-base font-extrabold text-[#061D38]">Aktivitas Terbaru</h3>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="mt-6 space-y-6">
                    <!-- Activity 1 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 flex-shrink-0 mt-1.5"></div>
                        <div>
                            <p class="text-xs text-gray-800 font-semibold">
                                <span class="font-extrabold text-gray-900">Admin Hukum</span> menyetujui <span class="font-extrabold text-gray-900">SK Peresmian Taman</span>
                            </p>
                            <span class="text-[10px] text-gray-400 font-medium block mt-0.5">10 Menit yang lalu</span>
                        </div>
                    </div>

                    <!-- Activity 2 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-orange-500 flex-shrink-0 mt-1.5"></div>
                        <div>
                            <p class="text-xs text-gray-800 font-semibold">
                                <span class="font-extrabold text-gray-900">Sistem</span> mengirim notifikasi revisi ke <span class="font-extrabold text-gray-900">Dinas Kesehatan</span>
                            </p>
                            <span class="text-[10px] text-gray-400 font-medium block mt-0.5">42 Menit yang lalu</span>
                        </div>
                    </div>

                    <!-- Activity 3 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-blue-500 flex-shrink-0 mt-1.5"></div>
                        <div>
                            <p class="text-xs text-gray-800 font-semibold">
                                <span class="font-extrabold text-gray-900">OPD Disdikpora</span> mengunggah draf baru: <span class="font-extrabold text-gray-900">Kurikulum Lokal v2</span>
                            </p>
                            <span class="text-[10px] text-gray-400 font-medium block mt-0.5">1 Jam yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Kinerja Review Minggu Ini Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-base font-extrabold text-[#061D38]">Kinerja Review Minggu Ini</h3>
                    <span class="text-xs font-bold text-emerald-600">📈 +5.2%</span>
                </div>

                <!-- Days Labels -->
                <div class="mt-8 flex items-center justify-between gap-2 text-center text-[10px] font-extrabold text-gray-400 px-4">
                    <span>SEN</span>
                    <span>SEL</span>
                    <span>RAB</span>
                    <span>KAM</span>
                    <span>JUM</span>
                    <span>SAB</span>
                    <span>MIN</span>
                </div>

                <!-- Bottom Stat Boxes Grid -->
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">WAKTU REVIEW RATA-RATA</span>
                        <p class="text-xl font-black text-[#061D38] mt-1 tracking-tight">14.2 Jam</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">TARGET TERCAPAI</span>
                        <p class="text-xl font-black text-emerald-600 mt-1 tracking-tight">92%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
