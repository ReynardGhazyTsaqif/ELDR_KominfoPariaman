<x-app-layout>
    <div class="space-y-6" x-data="{
        showModal: false,
        modalTitle: 'Tambah User Baru',
        currentTab: 'pengguna',
        form: { username: '', nama: '', role: 'admin_opd', opd: '', active: true },
        user1: true,
        user2: true,
        user3: true,
        user4: true,
        user5: false
    }">
        <!-- Top Sub-Navigation Tabs -->
        <div class="border-b border-gray-200 flex items-center gap-8 text-sm font-bold">
            <button @click="currentTab = 'pengguna'"
                    :class="currentTab === 'pengguna' ? 'border-b-2 border-[#062447] text-[#062447] pb-3 font-extrabold' : 'text-gray-400 hover:text-gray-600 pb-3'"
                    class="flex items-center gap-2 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Manajemen Pengguna</span>
            </button>

            <button @click="currentTab = 'log'"
                    :class="currentTab === 'log' ? 'border-b-2 border-[#062447] text-[#062447] pb-3 font-extrabold' : 'text-gray-400 hover:text-gray-600 pb-3'"
                    class="transition-all cursor-pointer">
                Log Aktivitas
            </button>

            <button @click="currentTab = 'akses'"
                    :class="currentTab === 'akses' ? 'border-b-2 border-[#062447] text-[#062447] pb-3 font-extrabold' : 'text-gray-400 hover:text-gray-600 pb-3'"
                    class="transition-all cursor-pointer">
                Hak Akses
            </button>
        </div>

        <!-- Page Header & CTA Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Manajemen Pengguna</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Kelola akses, peranan, dan status aktif staf di lingkungan ELDR Pariaman.
                </p>
            </div>
            <button @click="showModal = true; modalTitle = 'Tambah User Baru'; form = { username: '', nama: '', role: 'admin_opd', opd: '', active: true }"
                    type="button"
                    class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer uppercase tracking-wider">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>+ TAMBAH USER</span>
            </button>
        </div>

        <!-- 1. Top Row: 3 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Card 1: TOTAL PENGGUNA -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5 5 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL PENGGUNA</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">24</p>
                </div>
            </div>

            <!-- Card 2: USER AKTIF -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">USER AKTIF</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">21</p>
                </div>
            </div>

            <!-- Card 3: MENUNGGU VERIFIKASI -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU VERIFIKASI</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">3</p>
                </div>
            </div>
        </div>

        <!-- 2. Search & Filter Bar -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="relative flex-1 w-full">
                <input type="text" placeholder="Cari nama, username, atau OPD..."
                       class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-44">
                    <select class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer">
                        <option value="">Semua Role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin_opd">Admin OPD</option>
                        <option value="admin_desa">Admin Desa</option>
                        <option value="admin_hukum">Admin Hukum</option>
                        <option value="kabag_hukum">Kabag Hukum</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <button type="button" class="px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all cursor-pointer shadow-xs flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
            </div>
        </div>

        <!-- 3. Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">USERNAME</th>
                            <th class="py-3.5 px-6">NAMA</th>
                            <th class="py-3.5 px-6">ROLE</th>
                            <th class="py-3.5 px-6">OPD/DESA</th>
                            <th class="py-3.5 px-6 text-center">STATUS AKTIF</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1: super_pariaman -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">super_pariaman</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Andri Wijaya, S.Kom</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 bg-slate-200 text-slate-800 font-extrabold text-[10px] rounded-lg tracking-wide uppercase">
                                    Super Admin
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Diskominfo</td>
                            <td class="py-4 px-6 text-center">
                                <button @click="user1 = !user1" type="button"
                                        :class="user1 ? 'bg-[#062447]' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span :class="user1 ? 'translate-x-5' : 'translate-x-0'"
                                          class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit User'; form = { username: 'super_pariaman', nama: 'Andri Wijaya, S.Kom', role: 'super_admin', opd: 'Diskominfo', active: true }"
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

                        <!-- Row 2: admin_kesehatan -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">admin_kesehatan</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Dr. Sarah Fitriani</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-800 font-extrabold text-[10px] rounded-lg tracking-wide uppercase">
                                    Admin OPD
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Dinas Kesehatan</td>
                            <td class="py-4 px-6 text-center">
                                <button @click="user2 = !user2" type="button"
                                        :class="user2 ? 'bg-[#062447]' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span :class="user2 ? 'translate-x-5' : 'translate-x-0'"
                                          class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit User'; form = { username: 'admin_kesehatan', nama: 'Dr. Sarah Fitriani', role: 'admin_opd', opd: 'Dinas Kesehatan', active: true }"
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

                        <!-- Row 3: lurah_kampung_perak -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">lurah_kampung_perak</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Budi Setiawan</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 bg-teal-100 text-teal-800 font-extrabold text-[10px] rounded-lg tracking-wide uppercase">
                                    Admin Desa
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Kampung Perak</td>
                            <td class="py-4 px-6 text-center">
                                <button @click="user3 = !user3" type="button"
                                        :class="user3 ? 'bg-[#062447]' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span :class="user3 ? 'translate-x-5' : 'translate-x-0'"
                                          class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit User'; form = { username: 'lurah_kampung_perak', nama: 'Budi Setiawan', role: 'admin_desa', opd: 'Kampung Perak', active: true }"
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

                        <!-- Row 4: legal_staff_01 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">legal_staff_01</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Ratna Sari, M.H</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 bg-purple-100 text-purple-800 font-extrabold text-[10px] rounded-lg tracking-wide uppercase">
                                    Admin Hukum
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Bagian Hukum Setda</td>
                            <td class="py-4 px-6 text-center">
                                <button @click="user4 = !user4" type="button"
                                        :class="user4 ? 'bg-[#062447]' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span :class="user4 ? 'translate-x-5' : 'translate-x-0'"
                                          class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit User'; form = { username: 'legal_staff_01', nama: 'Ratna Sari, M.H', role: 'admin_hukum', opd: 'Bagian Hukum Setda', active: true }"
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

                        <!-- Row 5: kabag_hukum -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono font-bold text-[#061D38]">kabag_hukum</td>
                            <td class="py-4 px-6 font-bold text-gray-900">H. Syamsul Bahri, S.H</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 bg-amber-100 text-amber-800 font-extrabold text-[10px] rounded-lg tracking-wide uppercase">
                                    Kabag Hukum
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">Bagian Hukum Setda</td>
                            <td class="py-4 px-6 text-center">
                                <button @click="user5 = !user5" type="button"
                                        :class="user5 ? 'bg-[#062447]' : 'bg-gray-300'"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span :class="user5 ? 'translate-x-5' : 'translate-x-0'"
                                          class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit User'; form = { username: 'kabag_hukum', nama: 'H. Syamsul Bahri, S.H', role: 'kabag_hukum', opd: 'Bagian Hukum Setda', active: false }"
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

            <!-- Footer Pagination Bar -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Menampilkan 1-5 dari 24 pengguna</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">2</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 flex items-center justify-center transition-all">3</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Text -->
        <div class="text-center pt-2">
            <p class="text-xs font-semibold text-gray-400">&copy; 2024 Diskominfo Kota Pariaman - ELDR v2.1.0</p>
        </div>

        <!-- 4. Interactive Modal Dialog (Tambah / Edit User) -->
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
                        <label class="block text-xs font-bold text-gray-700 mb-1">Username Login</label>
                        <input type="text" x-model="form.username" placeholder="Contoh: admin_kesehatan" required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-mono text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap &amp; Gelar</label>
                        <input type="text" x-model="form.nama" placeholder="Contoh: Dr. Sarah Fitriani" required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Role / Peranan Otoritas</label>
                        <select x-model="form.role" required
                                class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 cursor-pointer transition-all">
                            <option value="super_admin">Super Admin</option>
                            <option value="admin_opd">Admin OPD</option>
                            <option value="admin_desa">Admin Desa</option>
                            <option value="admin_hukum">Admin Hukum</option>
                            <option value="kabag_hukum">Kabag Hukum</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">OPD / Desa Instansi</label>
                        <input type="text" x-model="form.opd" placeholder="Contoh: Dinas Kesehatan" required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
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
