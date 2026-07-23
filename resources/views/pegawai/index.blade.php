<x-app-layout>
    <div class="space-y-6">
        <!-- 1. Top Blue Info Banner Alert -->
        <div class="bg-[#D9E6FE] border border-blue-200/80 rounded-2xl p-5 shadow-xs flex items-start gap-3.5">
            <div class="w-8 h-8 rounded-full bg-blue-600/10 text-blue-700 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-extrabold text-[#061D38] text-sm">Informasi Direktori</h4>
                <p class="text-xs text-blue-900/80 mt-1 font-medium leading-relaxed">
                    Data pegawai dan unit kerja dikelola terpusat oleh Diskominfo Kota Pariaman. Data ini bersifat referensi hanya-baca (read-only) untuk keperluan verifikasi dokumen hukum.
                </p>
            </div>
        </div>

        <!-- 2. Page Header & Summary Stats Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-1">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Direktori Pegawai &amp; Unit Kerja</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Database resmi aparatur sipil negara di lingkungan Pemerintah Kota Pariaman.
                </p>
            </div>

            <!-- Top Right Stat Cards -->
            <div class="flex items-center gap-4 w-full sm:w-auto">
                <div class="bg-white rounded-2xl px-6 py-3 border border-gray-200/80 shadow-xs text-center flex-1 sm:flex-initial min-w-[130px]">
                    <h5 class="text-[10px] font-extrabold text-gray-400 tracking-wider uppercase">TOTAL PEGAWAI</h5>
                    <p class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">1,248</p>
                </div>
                <div class="bg-white rounded-2xl px-6 py-3 border border-gray-200/80 shadow-xs text-center flex-1 sm:flex-initial min-w-[120px]">
                    <h5 class="text-[10px] font-extrabold text-gray-400 tracking-wider uppercase">UNIT KERJA</h5>
                    <p class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">42</p>
                </div>
            </div>
        </div>

        <!-- 3. Search & Filter Bar -->
        <div class="bg-white border border-gray-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between gap-4 shadow-xs">
            <!-- Left controls -->
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <span class="bg-gray-100/90 px-3.5 py-2 rounded-xl text-xs font-bold text-gray-600 flex items-center gap-1.5 flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter Aktif:</span>
                </span>

                <div class="relative w-full sm:w-48">
                    <select class="w-full px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer">
                        <option value="">Semua Unit Kerja</option>
                        <option value="Diskominfo">Diskominfo Kota Pariaman</option>
                        <option value="Setda">Sekretariat Daerah</option>
                        <option value="Bappeda">Bappeda</option>
                        <option value="Dinkes">Dinas Kesehatan</option>
                        <option value="Disdik">Dinas Pendidikan</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div class="relative w-full sm:w-44">
                    <select class="w-full px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer">
                        <option value="">Semua Jabatan</option>
                        <option value="Kabid">Kepala Bidang</option>
                        <option value="Kabag">Kepala Bagian</option>
                        <option value="Analis">Analis</option>
                        <option value="Pranata">Pranata Komputer</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Right controls -->
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <button type="button" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all shadow-xs cursor-pointer">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Export PDF</span>
                </button>

                <button type="button" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all shadow-xs cursor-pointer">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak</span>
                </button>
            </div>
        </div>

        <!-- 4. Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NAMA PEGAWAI</th>
                            <th class="py-3.5 px-6">NIP</th>
                            <th class="py-3.5 px-6">UNIT KERJA / SATKER</th>
                            <th class="py-3.5 px-6">JABATAN / GOLONGAN</th>
                            <th class="py-3.5 px-6 text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1: Agus Muslim -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#DBEFEF] text-[#0F766E] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        AM
                                    </div>
                                    <span class="font-bold text-gray-900">Agus Muslim, S.Kom</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19850412 201101 1 003</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Diskominfo Kota Pariaman</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Kabid E-Government / IV.a</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>

                        <!-- Row 2: Siti Rahayu -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#FEF3C7] text-[#B45309] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        SR
                                    </div>
                                    <span class="font-bold text-gray-900">Siti Rahayu, M.Si</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19780922 200501 2 001</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Sekretariat Daerah</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Kepala Bagian Hukum / IV.b</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>

                        <!-- Row 3: Budi Pratama -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#E0E7FF] text-[#3730A3] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        BP
                                    </div>
                                    <span class="font-bold text-gray-900">Budi Pratama, S.H.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19920105 201801 1 005</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Bappeda</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Analis Perencanaan / III.b</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>

                        <!-- Row 4: Dewi Wahyuni -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#E2E8F0] text-[#334155] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        DW
                                    </div>
                                    <span class="font-bold text-gray-900">Dewi Wahyuni, S.T.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19890315 201402 2 008</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Diskominfo Kota Pariaman</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Pranata Komputer Madya / III.d</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>

                        <!-- Row 5: Hendri Fajar -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#E0E7FF] text-[#3730A3] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        HF
                                    </div>
                                    <span class="font-bold text-gray-900">Hendri Fajar, M.Kom</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19821110 200904 1 002</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Dinas Pariwisata</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Sekretaris Dinas / IV.a</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>

                        <!-- Row 6: Andi Lutfi -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#FEF3C7] text-[#B45309] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        AL
                                    </div>
                                    <span class="font-bold text-gray-900">Andi Lutfi, S.Sos</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-mono font-medium">19950718 202101 1 001</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Kecamatan Pariaman Tengah</td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Staff Administrasi / III.a</td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-0.5 bg-[#FEF3C7] text-[#B45309] font-black text-[10px] tracking-wider uppercase rounded">
                                    AKTIF
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination Bar -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Menampilkan 1 - 6 dari 1,248 pegawai</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">2</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">3</button>
                    <span class="px-1 text-gray-400">...</span>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">208</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>

        <!-- 5. Bottom Section: Distribusi Pegawai per Unit Kerja -->
        <div class="pt-4 space-y-4">
            <h3 class="text-lg font-black text-[#061D38] tracking-tight">Distribusi Pegawai per Unit Kerja</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Card 1: Diskominfo -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="bg-amber-100/70 text-amber-800 font-extrabold text-[10px] px-2.5 py-0.5 rounded-md">
                            Diskominfo
                        </span>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-400">Total Personel</p>
                        <h4 class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">64 Pegawai</h4>
                    </div>
                </div>

                <!-- Card 2: Setda -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <span class="bg-amber-100/70 text-amber-800 font-extrabold text-[10px] px-2.5 py-0.5 rounded-md">
                            Setda
                        </span>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-400">Total Personel</p>
                        <h4 class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">112 Pegawai</h4>
                    </div>
                </div>

                <!-- Card 3: Dinkes -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="bg-amber-100/70 text-amber-800 font-extrabold text-[10px] px-2.5 py-0.5 rounded-md">
                            Dinkes
                        </span>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-400">Total Personel</p>
                        <h4 class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">245 Pegawai</h4>
                    </div>
                </div>

                <!-- Card 4: Disdik -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <span class="bg-amber-100/70 text-amber-800 font-extrabold text-[10px] px-2.5 py-0.5 rounded-md">
                            Disdik
                        </span>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-400">Total Personel</p>
                        <h4 class="text-2xl font-black text-[#061D38] mt-0.5 tracking-tight">482 Pegawai</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
