<!-- Admin Hukum & Kabag Hukum Dashboard -->
<div class="space-y-6">
    <!-- 1. Top Row: 3 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Menunggu Tindak Lanjut -->
        <div class="bg-amber-50/40 border border-amber-200/80 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-amber-800 uppercase tracking-wider">MENUNGGU TINDAK LANJUT</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">18</p>
                <p class="text-xs font-semibold text-amber-700 mt-1 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Perlu penanganan segera</span>
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-100/70 border border-amber-200 flex items-center justify-center text-amber-700 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Disetujui Bulan Ini -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI BULAN INI</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">45</p>
                <p class="text-xs font-semibold text-gray-500 mt-1 flex items-center gap-1">
                    <span class="text-emerald-600 font-bold">↗ +12%</span> dari bulan lalu
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50/80 border border-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: Diminta Revisi Bulan Ini -->
        <div class="bg-orange-50/40 border border-orange-200/80 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-orange-800 uppercase tracking-wider">DIMINTA REVISI BULAN INI</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">12</p>
                <p class="text-xs font-semibold text-orange-700 mt-1 flex items-center gap-1">
                    <span>⚡ Tingkat akurasi dokumen: 88%</span>
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-orange-100/70 border border-orange-200 flex items-center justify-center text-orange-600 flex-shrink-0">
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
                <div class="w-6 h-6 rounded-md bg-amber-100 text-amber-800 flex items-center justify-center font-black text-sm">!</div>
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Prioritas (Perlu Tindakan)</h3>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold">
                <button type="button" class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
                <button type="button" class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 flex items-center gap-1.5 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                    </svg>
                    <span>Urutkan: Terlama</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Urutan</th>
                        <th class="py-3.5 px-6">Nama Dokumen</th>
                        <th class="py-3.5 px-6">OPD Pengirim</th>
                        <th class="py-3.5 px-6 text-center">Durasi Menunggu</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    <!-- Row 1: Draft Peraturan Walikota Tentang Tata Ruang v2.1 -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6">
                            <span class="w-7 h-7 rounded-full bg-rose-100 text-rose-700 font-extrabold text-xs flex items-center justify-center">01</span>
                        </td>
                        <td class="py-4 px-6">
                            <h4 class="font-bold text-[#061D38] text-sm">Draft Peraturan Walikota Tentang Tata Ruang v2.1</h4>
                            <span class="text-xs text-gray-400 font-mono block mt-0.5">ID: DOC-2023-0892</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Bappeda Kota Pariaman</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-rose-100 text-rose-800 font-extrabold px-3 py-1 rounded-lg text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                3 Hari 4 Jam
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="px-3 py-1.5 bg-white border border-emerald-500 hover:bg-emerald-50 text-emerald-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Setuju</span>
                                </button>
                                <a href="{{ route('documents.revision') }}" class="px-3 py-1.5 bg-white border border-orange-400 hover:bg-orange-50 text-orange-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Revisi</span>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: SK Penunjukan Panitia Pelaksana MTQ Nasional -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6">
                            <span class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 font-extrabold text-xs flex items-center justify-center">02</span>
                        </td>
                        <td class="py-4 px-6">
                            <h4 class="font-bold text-[#061D38] text-sm">SK Penunjukan Panitia Pelaksana MTQ Nasional</h4>
                            <span class="text-xs text-gray-400 font-mono block mt-0.5">ID: DOC-2023-0904</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Bagian Kesra Setda</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-900 font-extrabold px-3 py-1 rounded-lg text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                1 Hari 2 Jam
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="px-3 py-1.5 bg-white border border-emerald-500 hover:bg-emerald-50 text-emerald-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Setuju</span>
                                </button>
                                <button type="button" class="px-3 py-1.5 bg-white border border-orange-400 hover:bg-orange-50 text-orange-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Revisi</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Perjanjian Kerjasama Diskominfo & Telkom Indonesia -->
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="py-4 px-6">
                            <span class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 font-extrabold text-xs flex items-center justify-center">03</span>
                        </td>
                        <td class="py-4 px-6">
                            <h4 class="font-bold text-[#061D38] text-sm">Perjanjian Kerjasama Diskominfo & Telkom Indonesia</h4>
                            <span class="text-xs text-gray-400 font-mono block mt-0.5">ID: DOC-2023-0912</span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Diskominfo</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 font-extrabold px-3 py-1 rounded-lg text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                18 Jam
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="px-3 py-1.5 bg-white border border-emerald-500 hover:bg-emerald-50 text-emerald-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Setuju</span>
                                </button>
                                <button type="button" class="px-3 py-1.5 bg-white border border-orange-400 hover:bg-orange-50 text-orange-600 font-bold rounded-lg text-xs flex items-center gap-1 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Revisi</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-[#F9FAFB] border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
            <span>Menampilkan 3 dari 18 dokumen antrian prioritas</span>
            <a href="#" class="font-bold text-[#061D38] hover:underline flex items-center gap-1">
                Lihat Semua Antrian →
            </a>
        </div>
    </div>

    <!-- 3. Bottom 2 Columns Grid: Aktivitas Terbaru & Kinerja Review Minggu Ini -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left: Aktivitas Terbaru Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-base font-extrabold text-[#061D38]">Aktivitas Terbaru</h3>
                </div>

                <div class="mt-6 space-y-5">
                    <!-- Activity 1 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">Selesai Review: Peraturan Walikota No. 12 Tahun 2023</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Baru saja • Oleh Kabag Hukum</p>
                        </div>
                    </div>

                    <!-- Activity 2 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">Permintaan Revisi: Draft SK Kepegawaian (Dinkes)</h4>
                            <p class="text-xs text-gray-400 mt-0.5">2 jam yang lalu • Alasan: Kesalahan Penomoran</p>
                        </div>
                    </div>

                    <!-- Activity 3 -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">Dokumen Baru: Proposal Hibah Yayasan Cerdas</h4>
                            <p class="text-xs text-gray-400 mt-0.5">4 jam yang lalu • Dikirim oleh Bagian Umum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Kinerja Review Minggu Ini Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <h3 class="text-base font-extrabold text-[#061D38]">Kinerja Review Minggu Ini</h3>
                </div>

                <!-- Graphic & Bar Labels -->
                <div class="mt-6 h-32 flex items-end justify-between gap-3 px-4 border-b border-gray-100 pb-3">
                    <div class="w-full flex flex-col items-center gap-1.5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">SEN</span>
                    </div>
                    <div class="w-full flex flex-col items-center gap-1.5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">SEL</span>
                    </div>
                    <div class="w-full flex flex-col items-center gap-1.5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">RAB</span>
                    </div>
                    <div class="w-full flex flex-col items-center gap-1.5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">KAM</span>
                    </div>
                    <div class="w-full flex flex-col items-center gap-1.5">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">JUM</span>
                    </div>
                </div>

                <!-- Stat Boxes -->
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="p-3.5 bg-gray-50 rounded-xl">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">RATA-RATA WAKTU REVIEW</span>
                        <p class="text-xl font-black text-[#061D38] mt-1 tracking-tight">1.4 Hari</p>
                    </div>
                    <div class="p-3.5 bg-gray-50 rounded-xl">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">DOKUMEN TERSELESAIKAN</span>
                        <p class="text-xl font-black text-[#061D38] mt-1 tracking-tight">24 Dokumen</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
