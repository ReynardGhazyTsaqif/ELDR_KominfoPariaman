<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header & Context -->
        <div>
            <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Manajemen Referensi Status</h2>
            <p class="text-xs font-semibold text-gray-500 mt-1">
                Daftar nilai standar untuk status dokumen dan pengajuan dalam sistem ELDR.
            </p>
        </div>

        <!-- 1. Tabbed Card Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <!-- Tabs Navigation Header -->
            <div class="border-b border-gray-100 px-6 pt-4 flex items-center gap-8 text-sm font-bold" x-data="{ tab: 'dokumen' }">
                <button @click="tab = 'dokumen'"
                        :class="tab === 'dokumen' ? 'border-b-2 border-[#062447] text-[#062447] pb-3' : 'text-gray-400 hover:text-gray-600 pb-3'"
                        class="transition-all cursor-pointer">
                    Status Dokumen
                </button>
                <button @click="tab = 'pengajuan'"
                        :class="tab === 'pengajuan' ? 'border-b-2 border-[#062447] text-[#062447] pb-3' : 'text-gray-400 hover:text-gray-600 pb-3'"
                        class="transition-all cursor-pointer">
                    Status Pengajuan
                </button>
            </div>

            <!-- Tab Content: Status Dokumen Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">ID</th>
                            <th class="py-3.5 px-6">LABEL STATUS</th>
                            <th class="py-3.5 px-6">DESKRIPSI OPERASIONAL</th>
                            <th class="py-3.5 px-6 text-center">VISUAL BADGE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1: Draft -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono text-xs text-gray-500 font-medium">D01</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Draft</td>
                            <td class="py-4 px-6 text-xs text-gray-600 leading-relaxed">
                                Dokumen sedang dalam tahap penyusunan awal oleh penyusun.
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-gray-100 text-gray-700 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                    DRAFT
                                </span>
                            </td>
                        </tr>

                        <!-- Row 2: Review Internal -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono text-xs text-gray-500 font-medium">D02</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Review Internal</td>
                            <td class="py-4 px-6 text-xs text-gray-600 leading-relaxed">
                                Tahap pemeriksaan substansi oleh tim internal unit kerja.
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-50 text-blue-700 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                    REVIEW
                                </span>
                            </td>
                        </tr>

                        <!-- Row 3: Finalisasi -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono text-xs text-gray-500 font-medium">D03</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Finalisasi</td>
                            <td class="py-4 px-6 text-xs text-gray-600 leading-relaxed">
                                Perbaikan akhir berdasarkan masukan review sebelum pengajuan formal.
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-amber-50 text-amber-800 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                    FINALISASI
                                </span>
                            </td>
                        </tr>

                        <!-- Row 4: Arsip -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono text-xs text-gray-500 font-medium">D04</td>
                            <td class="py-4 px-6 font-bold text-gray-900">Arsip</td>
                            <td class="py-4 px-6 text-xs text-gray-600 leading-relaxed">
                                Dokumen telah selesai diproses dan disimpan dalam database permanen.
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                    TERARSIP
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Card Footer Strip -->
            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-gray-500 font-medium">
                <span>* Catatan: Tabel ini bersifat referensi (Read-Only) untuk Super Admin. Perubahan ID memerlukan otorisasi Database Administrator.</span>
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-1.5 transition-all shadow-xs cursor-pointer flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Ekspor CSV</span>
                </button>
            </div>
        </div>

        <!-- 2. Bottom Row: 3 Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Card 1: Integritas Data (Dark Navy) -->
            <div class="bg-[#062447] text-white rounded-2xl p-6 shadow-md flex flex-col justify-between space-y-3">
                <div class="w-8 h-8 rounded-full bg-white/10 text-amber-300 flex items-center justify-center font-bold text-sm">
                    ℹ
                </div>
                <div>
                    <h4 class="font-extrabold text-base text-white">Integritas Data</h4>
                    <p class="text-xs text-blue-100 leading-relaxed mt-1">
                        Setiap kode status (misal: D01) dikunci secara relasional untuk mencegah inkonsistensi pada ribuan dokumen legal yang tersimpan.
                    </p>
                </div>
            </div>

            <!-- Card 2: Distribusi Status -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col justify-between space-y-3">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#062447] flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-[#061D38] text-base">Distribusi Status</h4>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1">
                        Status 'Draft' mencakup 42% dari total dokumen aktif saat ini di lingkungan Kota Pariaman.
                    </p>
                </div>
            </div>

            <!-- Card 3: Akses Terbatas -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col justify-between space-y-3">
                <div class="w-8 h-8 rounded-lg bg-slate-50 text-gray-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-[#061D38] text-base">Akses Terbatas</h4>
                    <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1">
                        Halaman referensi ini hanya dapat diakses oleh level 'Super Admin' dan 'Kepala Diskominfo'.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
