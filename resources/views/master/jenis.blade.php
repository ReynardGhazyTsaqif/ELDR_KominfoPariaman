<x-app-layout>
    <div class="space-y-6" x-data="{ showModal: false, modalTitle: 'Tambah Jenis Dokumen Baru', form: { kode: '', nama: '', deskripsi: '' } }">
        <!-- Breadcrumb Header -->
        <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
            <span>Data Master</span>
            <span>/</span>
            <span class="text-[#061D38] font-bold">Jenis Dokumen</span>
        </div>

        <!-- Page Header & CTA Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Master Jenis Dokumen</h2>
            </div>
            <button @click="showModal = true; modalTitle = 'Tambah Jenis Dokumen Baru'; form = { kode: '', nama: '', deskripsi: '' }"
                    type="button"
                    class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer tracking-wider uppercase">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>+ TAMBAH JENIS BARU</span>
            </button>
        </div>

        <!-- 1. Top Row: 3 Information Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Card 1: Legalitas Terjamin (Dark Navy) -->
            <div class="bg-[#061D38] text-white rounded-2xl p-6 shadow-md flex flex-col justify-between space-y-4">
                <div class="w-9 h-9 rounded-xl bg-white/10 text-amber-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-base text-white">Legalitas Terjamin</h4>
                    <p class="text-xs text-blue-100/90 leading-relaxed mt-1 font-medium">
                        Setiap jenis dokumen yang didaftarkan telah melalui tahap sinkronisasi dengan sistem perundang-undangan nasional.
                    </p>
                </div>
            </div>

            <!-- Card 2: Tracking Revisi (White Card) -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col justify-between space-y-4">
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-[#061D38] text-base">Tracking Revisi</h4>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1">
                        Sistem ELDR secara otomatis melacak setiap perubahan nama dan kode jenis dokumen untuk arsip riwayat.
                    </p>
                </div>
            </div>

            <!-- Card 3: Integrasi Publik (White Card) -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col justify-between space-y-4">
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-[#061D38] text-base">Integrasi Publik</h4>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1">
                        Jenis dokumen yang aktif akan muncul sebagai opsi utama di Portal JDIH Kota Pariaman.
                    </p>
                </div>
            </div>
        </div>

        <!-- 2. Filter & Data Strip -->
        <div class="bg-gray-100/70 border border-gray-200/80 rounded-2xl p-3 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <button type="button" class="px-3.5 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-1.5 transition-all shadow-xs cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
                <button type="button" class="px-3.5 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-1.5 transition-all shadow-xs cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Export</span>
                </button>
            </div>

            <span class="text-xs font-semibold text-gray-500 px-2">Menampilkan 3 data</span>
        </div>

        <!-- 3. Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-8 w-32">KODE</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-8 text-right w-32">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                        <!-- Row 1: Perda/Perwako -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-8">
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 font-mono font-extrabold rounded text-xs">
                                    PRD
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <h4 class="font-extrabold text-[#061D38] text-sm">Perda/Perwako</h4>
                                    <p class="text-xs font-medium text-gray-400 mt-0.5">Peraturan Daerah atau Peraturan Walikota</p>
                                </div>
                            </td>
                            <td class="py-4 px-8 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Jenis Dokumen'; form = { kode: 'PRD', nama: 'Perda/Perwako', deskripsi: 'Peraturan Daerah atau Peraturan Walikota' }"
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

                        <!-- Row 2: SK/Keputusan Walikota-Sekda -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-8">
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 font-mono font-extrabold rounded text-xs">
                                    SKW
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <h4 class="font-extrabold text-[#061D38] text-sm">SK/Keputusan Walikota-Sekda</h4>
                                    <p class="text-xs font-medium text-gray-400 mt-0.5">Surat Keputusan Pimpinan Tertinggi Daerah</p>
                                </div>
                            </td>
                            <td class="py-4 px-8 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Jenis Dokumen'; form = { kode: 'SKW', nama: 'SK/Keputusan Walikota-Sekda', deskripsi: 'Surat Keputusan Pimpinan Tertinggi Daerah' }"
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

                        <!-- Row 3: Perdes/Perkades -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-8">
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 font-mono font-extrabold rounded text-xs">
                                    PDS
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <h4 class="font-extrabold text-[#061D38] text-sm">Perdes/Perkades</h4>
                                    <p class="text-xs font-medium text-gray-400 mt-0.5">Peraturan atau Keputusan Tingkat Desa/Kelurahan</p>
                                </div>
                            </td>
                            <td class="py-4 px-8 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button @click="showModal = true; modalTitle = 'Edit Jenis Dokumen'; form = { kode: 'PDS', nama: 'Perdes/Perkades', deskripsi: 'Peraturan atau Keputusan Tingkat Desa/Kelurahan' }"
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

            <!-- Footer Strip & Pagination -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Data dikelola oleh Bagian Hukum Kota Pariaman</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">›</button>
                </div>
            </div>
        </div>

        <!-- 4. Interactive Modal Dialog (Tambah / Edit Jenis Dokumen) -->
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
                        <label class="block text-xs font-bold text-gray-700 mb-1">Kode Jenis Dokumen</label>
                        <input type="text" x-model="form.kode" placeholder="Contoh: PRD, SKW, PDS..." required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-mono text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Jenis Dokumen</label>
                        <input type="text" x-model="form.nama" placeholder="Contoh: Perda/Perwako" required
                               class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Ringkas</label>
                        <textarea x-model="form.deskripsi" rows="3" placeholder="Deskripsi peruntukan jenis dokumen..."
                                  class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all"></textarea>
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
