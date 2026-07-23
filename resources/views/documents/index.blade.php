<x-app-layout>
    <div class="space-y-6">
        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Dokumen -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL DOKUMEN</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">1.284</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">856</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIPROSES</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">342</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DITOLAK</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">86</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Filter Card Container -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Cari Nama / Perihal -->
                <div>
                    <label for="search" class="block text-xs font-bold text-gray-700 mb-2">Cari Nama/Perihal</label>
                    <div class="relative">
                        <input type="text" id="search" placeholder="Masukkan kata kunci..."
                               class="w-full px-3.5 py-2.5 pl-9 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Jenis Dokumen -->
                <div>
                    <label for="jenis" class="block text-xs font-bold text-gray-700 mb-2">Jenis Dokumen</label>
                    <div class="relative">
                        <select id="jenis" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                            <option value="">Semua Jenis</option>
                            <option value="1">Peraturan Daerah</option>
                            <option value="2">Peraturan Walikota</option>
                            <option value="3">Surat Keputusan</option>
                            <option value="4">Nota Dinas</option>
                            <option value="5">Peraturan Desa</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-bold text-gray-700 mb-2">Status</label>
                    <div class="relative">
                        <select id="status" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                            <option value="">Semua Status</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="diproses">Diproses</option>
                            <option value="pengajuan">Pengajuan</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Rentang Tanggal -->
                <div>
                    <label for="tanggal" class="block text-xs font-bold text-gray-700 mb-2">Rentang Tanggal</label>
                    <div class="relative">
                        <input type="text" id="tanggal" value="01/01/2023 - 31/12/2023"
                               class="w-full px-3.5 py-2.5 pl-9 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons Right Aligned -->
            <div class="mt-5 flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" class="px-5 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl transition-all shadow-xs cursor-pointer">
                    Reset
                </button>
                <button type="button" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari Dokumen</span>
                </button>
            </div>
        </div>

        <!-- 3. Daftar Dokumen Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NAMA FILE</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">PERIHAL</th>
                            <th class="py-3.5 px-6">TANGGAL UPLOAD</th>
                            <th class="py-3.5 px-4 text-center">STATUS</th>
                            <th class="py-3.5 px-6">OPD/DESA PENGAJU</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1: PERDA_NO12_2023.pdf -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <span class="font-extrabold text-[#061D38]">PERDA_NO12_2023.pdf</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600">Peraturan Daerah</td>
                            <td class="py-4 px-6 text-xs text-gray-500 max-w-xs truncate">Rencana Pembangunan Jangka Menengah D...</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">12 Okt 2023</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-emerald-50 text-emerald-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">DISETUJUI</span>
                            </td>
                            <td class="py-4 px-6 text-xs font-bold text-gray-600">BAPPEDA</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" title="Detail" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Edit" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Unduh" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: PERWAKO_A23_REV.pdf -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <span class="font-extrabold text-[#061D38]">PERWAKO_A23_REV.pdf</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600">Peraturan Walikota</td>
                            <td class="py-4 px-6 text-xs text-gray-500 max-w-xs truncate">Standar Operasional Prosedur Pelayanan Put...</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">14 Okt 2023</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-amber-50 text-amber-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">DIPROSES</span>
                            </td>
                            <td class="py-4 px-6 text-xs font-bold text-gray-600">DISKOMINFO</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" title="Detail" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Edit" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Unduh" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: DRAFT_SK_LURAH.docx -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    DOC
                                </div>
                                <span class="font-extrabold text-[#061D38]">DRAFT_SK_LURAH.docx</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600">Surat Keputusan</td>
                            <td class="py-4 px-6 text-xs text-gray-500 max-w-xs truncate">Pengangkatan Ketua RT/RW Kelurahan Karar...</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">15 Okt 2023</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-[#E2E8F0] text-[#334155] font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">PENGAJUAN</span>
                            </td>
                            <td class="py-4 px-6 text-xs font-bold text-gray-600">Kec. Pariaman Tengah</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" title="Detail" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Edit" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Unduh" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: LAPORAN_TRIWULAN_V1.pdf -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <span class="font-extrabold text-[#061D38]">LAPORAN_TRIWULAN_V1.pdf</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600">Nota Dinas</td>
                            <td class="py-4 px-6 text-xs text-gray-500 max-w-xs truncate">Laporan Keuangan Triwulan III - Dinas Pasar,...</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">08 Okt 2023</td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block bg-rose-50 text-rose-700 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">DITOLAK</span>
                            </td>
                            <td class="py-4 px-6 text-xs font-bold text-gray-600">Dinas Perindustrian</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" title="Detail" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Edit" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" title="Unduh" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination Bar -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Menampilkan 1-10 dari 45 item</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">2</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">3</button>
                    <span class="px-1 text-gray-400">...</span>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">5</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
