<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header & CTA Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Manajemen Data Desa</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Kelola daftar administratif desa untuk sistem ELDR Kota Pariaman.
                </p>
            </div>
            <button type="button" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Desa Baru</span>
            </button>
        </div>

        <!-- 1. Top Row: 3 Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Card 1: Total Desa Terdaftar (Dark Navy) -->
            <div class="bg-[#123258] text-white rounded-2xl p-6 shadow-md relative overflow-hidden flex flex-col justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-blue-200 uppercase tracking-wider">TOTAL DESA TERDAFTAR</h4>
                    <p class="text-4xl font-black text-white mt-2 tracking-tight">72</p>
                </div>
                <p class="text-xs font-medium text-blue-200 mt-4 flex items-center gap-1">
                    <span>📈 +2 Penambahan bulan ini</span>
                </p>

                <!-- Watermark Background Icon -->
                <svg class="w-24 h-24 text-white/5 absolute -right-3 -bottom-3 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>

            <!-- Card 2: Penyebaran Kecamatan -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col justify-between">
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PENYEBARAN KECAMATAN</h4>

                <div class="space-y-4 my-auto pt-2">
                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1">
                            <span class="text-gray-700">Pariaman Tengah</span>
                            <span class="text-[#061D38]">22 Desa</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-[#062447] h-2 rounded-full w-4/5"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs font-bold mb-1">
                            <span class="text-gray-700">Pariaman Utara</span>
                            <span class="text-[#061D38]">18 Desa</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-[#F5BF38] h-2 rounded-full w-2/3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Integritas Data -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-500 border border-amber-200 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h4 class="font-extrabold text-[#061D38] text-sm">Integritas Data</h4>
                <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1">
                    Semua data desa telah diverifikasi sesuai dengan Kode Wilayah Kemendagri 2024.
                </p>
            </div>
        </div>

        <!-- 2. Search & Filter Bar -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="relative flex-1 w-full">
                <input type="text" placeholder="Cari nama atau kode desa..."
                       class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none cursor-pointer">
                    <option value="">Semua Kecamatan</option>
                    <option value="1">Pariaman Tengah</option>
                    <option value="2">Pariaman Utara</option>
                    <option value="3">Pariaman Selatan</option>
                    <option value="4">Pariaman Timur</option>
                </select>

                <button type="button" class="p-2.5 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-gray-600 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>

                <button type="button" class="p-2.5 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-gray-600 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- 3. Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">KODE DESA</th>
                            <th class="py-3.5 px-6">NAMA DESA</th>
                            <th class="py-3.5 px-6">TANGGAL MULAI</th>
                            <th class="py-3.5 px-6">TANGGAL SELESAI</th>
                            <th class="py-3.5 px-6 text-center">STATUS</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">DS-001-PRT</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Ampalu</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">12 Jan 2024</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">31 Des 2024</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-9 h-5 bg-[#123258] rounded-full p-0.5 transition-all flex items-center justify-end">
                                        <span class="w-4 h-4 bg-white rounded-full"></span>
                                    </span>
                                    <span class="text-xs font-bold text-[#123258]">Aktif</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button type="button" class="text-gray-400 hover:text-amber-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">DS-002-PRT</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Capaian Hilir</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">15 Jan 2024</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">-</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-9 h-5 bg-[#123258] rounded-full p-0.5 transition-all flex items-center justify-end">
                                        <span class="w-4 h-4 bg-white rounded-full"></span>
                                    </span>
                                    <span class="text-xs font-bold text-[#123258]">Aktif</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button type="button" class="text-gray-400 hover:text-amber-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">DS-009-PRU</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Pariaman Utara Lama</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">01 Jan 2020</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">31 Des 2023</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-9 h-5 bg-gray-300 rounded-full p-0.5 transition-all flex items-center justify-start">
                                        <span class="w-4 h-4 bg-white rounded-full"></span>
                                    </span>
                                    <span class="text-xs font-bold text-gray-400">Nonaktif</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button type="button" class="text-gray-400 hover:text-amber-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">DS-014-PRS</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Maro Hilir</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">05 Feb 2024</td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">-</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-9 h-5 bg-[#123258] rounded-full p-0.5 transition-all flex items-center justify-end">
                                        <span class="w-4 h-4 bg-white rounded-full"></span>
                                    </span>
                                    <span class="text-xs font-bold text-[#123258]">Aktif</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button type="button" class="text-gray-400 hover:text-amber-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Menampilkan 1 - 4 dari 72 Desa</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">2</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">3</button>
                    <span class="px-1 text-gray-400">...</span>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">18</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
