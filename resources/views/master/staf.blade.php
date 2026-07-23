<x-app-layout>
    <div class="space-y-6" x-data="{ showModal: false, modalTitle: 'Tambah Staf Desa Baru', form: { nik: '', nama: '', desa: '', status: 'Aktif' } }">
        <!-- Breadcrumb & Context Header -->
        <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
            <span>Data Master</span>
            <span>&rsaquo;</span>
            <span class="text-[#061D38] font-bold">Staf Desa &amp; Masyarakat</span>
        </div>

        <!-- Page Header & CTA Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Manajemen Staf Desa</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Kelola data seluruh staf desa dan masyarakat yang terintegrasi dalam sistem ELDR untuk administrasi legalitas desa.
                </p>
            </div>
            <button @click="showModal = true; modalTitle = 'Tambah Staf Desa Baru'; form = { nik: '', nama: '', desa: '', status: 'Aktif' }"
                    type="button"
                    class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>+ Tambah Staf</span>
            </button>
        </div>

        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1: TOTAL STAF -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL STAF</h4>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-3xl font-black text-[#061D38] tracking-tight">124</span>
                        <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-1.5 py-0.5 rounded">+12%</span>
                    </div>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5 5 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: AKUN AKTIF -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">AKUN AKTIF</h4>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-3xl font-black text-[#061D38] tracking-tight">118</span>
                        <span class="text-xs font-semibold text-gray-400">95%</span>
                    </div>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: MENUNGGU -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU</h4>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-3xl font-black text-[#061D38] tracking-tight">4</span>
                        <span class="text-xs font-semibold text-amber-600">Verifikasi</span>
                    </div>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Card 4: NON-AKTIF -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">NON-AKTIF</h4>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-3xl font-black text-[#061D38] tracking-tight">2</span>
                        <span class="text-xs font-semibold text-gray-400">Akun</span>
                    </div>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Search & Filter Bar -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Search input -->
            <div class="relative flex-1 w-full">
                <input type="text" placeholder="Cari berdasarkan NIK atau Nama..."
                       class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Filter actions -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-48">
                    <select class="w-full px-4 py-2.5 pl-9 pr-8 bg-white border border-gray-200 rounded-xl text-sm text-gray-700 font-semibold focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer">
                        <option value="">Semua Desa</option>
                        <option value="Kampung Jawa">Kampung Jawa</option>
                        <option value="Marunggi">Marunggi</option>
                        <option value="Padang Biriak-Biriak">Padang Biriak-Biriak</option>
                        <option value="Tungkal Utara">Tungkal Utara</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <button type="button" class="px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all cursor-pointer shadow-xs flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter Lanjut</span>
                </button>

                <button type="button" title="Unduh Data Staf" class="p-2.5 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-gray-600 transition-all cursor-pointer shadow-xs flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <th class="py-3.5 px-6">NO.</th>
                            <th class="py-3.5 px-6">NIK</th>
                            <th class="py-3.5 px-6">NAMA LENGKAP</th>
                            <th class="py-3.5 px-6">DESA (RELASI)</th>
                            <th class="py-3.5 px-6 text-center">STATUS AKUN</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1: Ahmad Hidayat -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 text-xs text-gray-400 font-bold">01</td>
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">1377011204850001</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#DCE7F7] text-[#1E40AF] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        AH
                                    </div>
                                    <span class="font-bold text-gray-900">Ahmad Hidayat, S.Sos</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Kampung Jawa</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Data Staf'; form = { nik: '1377011204850001', nama: 'Ahmad Hidayat, S.Sos', desa: 'Kampung Jawa', status: 'Aktif' }"
                                            type="button" class="text-gray-400 hover:text-[#062447] transition-all cursor-pointer" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer" title="Hapus">
                                        <svg class="w-4 h-4 text-rose-400 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: Siti Maryam -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 text-xs text-gray-400 font-bold">02</td>
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">1377012509920004</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#FEF3C7] text-[#D97706] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        SM
                                    </div>
                                    <span class="font-bold text-gray-900">Siti Maryam</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Marunggi</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Data Staf'; form = { nik: '1377012509920004', nama: 'Siti Maryam', desa: 'Marunggi', status: 'Aktif' }"
                                            type="button" class="text-gray-400 hover:text-[#062447] transition-all cursor-pointer" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer" title="Hapus">
                                        <svg class="w-4 h-4 text-rose-400 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: Budi Pratama -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 text-xs text-gray-400 font-bold">03</td>
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">1377020303880010</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#E2E8F0] text-[#475569] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        BP
                                    </div>
                                    <span class="font-bold text-gray-900">Budi Pratama</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Padang Biriak-Biriak</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100/80 text-amber-800 rounded-full text-xs font-bold border border-amber-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Menunggu Verifikasi
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Data Staf'; form = { nik: '1377020303880010', nama: 'Budi Pratama', desa: 'Padang Biriak-Biriak', status: 'Menunggu' }"
                                            type="button" class="text-gray-400 hover:text-[#062447] transition-all cursor-pointer" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer" title="Hapus">
                                        <svg class="w-4 h-4 text-rose-400 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: Rizky Kurniawan -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 text-xs text-gray-400 font-bold">04</td>
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">1377011502800002</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-[#E2E8F0] text-[#475569] font-bold text-xs flex items-center justify-center flex-shrink-0">
                                        RK
                                    </div>
                                    <span class="font-bold text-gray-900">Rizky Kurniawan</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Tungkal Utara</td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold border border-gray-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Non-Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Data Staf'; form = { nik: '1377011502800002', nama: 'Rizky Kurniawan', desa: 'Tungkal Utara', status: 'Non-Aktif' }"
                                            type="button" class="text-gray-400 hover:text-[#062447] transition-all cursor-pointer" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-gray-400 hover:text-rose-600 transition-all cursor-pointer" title="Hapus">
                                        <svg class="w-4 h-4 text-rose-400 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <span>Menampilkan 1-4 dari 124 Staf</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">2</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">3</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>

        <!-- 4. Interactive Modal Dialog (Tambah / Edit Staf) -->
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4"
             style="display: none;">
            <div @click.outside="showModal = false"
                 class="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-lg overflow-hidden transform transition-all">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-extrabold text-[#061D38] text-base" x-text="modalTitle"></h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 hover:text-gray-600 transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form @submit.prevent="showModal = false" class="p-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" x-model="form.nik" placeholder="Masukkan 16 digit NIK..." required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-mono text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap &amp; Gelar</label>
                        <input type="text" x-model="form.nama" placeholder="Contoh: Ahmad Hidayat, S.Sos" required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Desa (Relasi Administrative)</label>
                        <select x-model="form.desa" required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 cursor-pointer transition-all">
                            <option value="">-- Pilih Desa --</option>
                            <option value="Kampung Jawa">Kampung Jawa</option>
                            <option value="Marunggi">Marunggi</option>
                            <option value="Padang Biriak-Biriak">Padang Biriak-Biriak</option>
                            <option value="Tungkal Utara">Tungkal Utara</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Status Akun</label>
                        <select x-model="form.status"
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 cursor-pointer transition-all">
                            <option value="Aktif">Aktif</option>
                            <option value="Menunggu">Menunggu Verifikasi</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button @click="showModal = false" type="button" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl transition-all shadow-xs cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
