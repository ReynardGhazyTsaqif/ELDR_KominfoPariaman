<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header & Top Action Buttons -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Antrian Persetujuan</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Kelola dan tinjau draf dokumen hukum yang memerlukan validasi Anda.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all cursor-pointer shadow-xs">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter Lanjut</span>
                </button>
                <button type="button" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all cursor-pointer shadow-xs">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Export PDF</span>
                </button>
            </div>
        </div>

        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1: Menunggu Review -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU REVIEW</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">05</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: Sedang Direvisi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">SEDANG DIREVISI</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">12</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: Disetujui Hari Ini -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI HARI INI</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">08</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Card 4: Melebihi SLA -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MELEBIHI SLA</h4>
                    <p class="text-3xl font-black text-rose-600 mt-1 tracking-tight">02</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Antrian Dokumen Menunggu Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Dokumen Menunggu</h3>
                <div class="flex items-center gap-2 text-xs font-semibold">
                    <span class="text-gray-500">Tampilkan:</span>
                    <select class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-1.5 text-xs font-bold text-gray-700 focus:outline-none cursor-pointer">
                        <option value="">Semua Jenis</option>
                        <option value="perwako">PERWAKO</option>
                        <option value="sk">SK_WAKO</option>
                        <option value="instruksi">INSTRUKSI</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NAMA FILE</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">PERIHAL</th>
                            <th class="py-3.5 px-6">PENGAJU</th>
                            <th class="py-3.5 px-6 text-center">TANGGAL DIAJUKAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <div>
                                    <a href="{{ route('documents.show') }}" class="font-extrabold text-[#061D38] hover:underline block">Draf_Perwako_024_2023.pdf</a>
                                    <span class="text-[11px] text-gray-400 font-medium block">3.2 MB • Versi 1.0</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">PERWAKO</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 max-w-xs leading-relaxed">
                                Pemberian Insentif Pajak Daerah Sektor Pariwisata
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 flex items-center gap-2">
                                🏢 Bapenda Kota Pariaman
                            </td>
                            <td class="py-4 px-6 text-center text-xs">
                                <span class="font-bold text-gray-800 block">12 Okt 2023</span>
                                <span class="inline-block mt-0.5 text-rose-600 font-bold text-[10px]">⏰ Menunggu 3 hari</span>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <div>
                                    <a href="{{ route('documents.show') }}" class="font-extrabold text-[#061D38] hover:underline block">SK_Wako_Penetapan_Lahan.pdf</a>
                                    <span class="text-[11px] text-gray-400 font-medium block">1.8 MB • Versi 2.0</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">SK_WAKO</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 max-w-xs leading-relaxed">
                                Penetapan Lokasi Pembangunan Pasar Seni Angso Duo
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 flex items-center gap-2">
                                🏢 DPUPR
                            </td>
                            <td class="py-4 px-6 text-center text-xs">
                                <span class="font-bold text-gray-800 block">14 Okt 2023</span>
                                <span class="inline-block mt-0.5 text-amber-600 font-bold text-[10px]">⏰ Menunggu 1 hari</span>
                            </td>
                        </tr>

                        <!-- Row 3 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <div>
                                    <a href="{{ route('documents.show') }}" class="font-extrabold text-[#061D38] hover:underline block">Instruksi_Wako_Netralitas_ASN.pdf</a>
                                    <span class="text-[11px] text-gray-400 font-medium block">0.9 MB • Versi 1.0</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">INSTRUKSI</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 max-w-xs leading-relaxed">
                                Netralitas ASN dalam Pelaksanaan Pemilu Serentak
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 flex items-center gap-2">
                                👥 BKPSDM
                            </td>
                            <td class="py-4 px-6 text-center text-xs">
                                <span class="font-bold text-gray-800 block">16 Okt 2023</span>
                                <span class="inline-block mt-0.5 text-gray-400 font-medium text-[10px]">Baru diajukan</span>
                            </td>
                        </tr>

                        <!-- Row 4 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <div>
                                    <a href="{{ route('documents.show') }}" class="font-extrabold text-[#061D38] hover:underline block">Draf_MoU_Pariwisata.pdf</a>
                                    <span class="text-[11px] text-gray-400 font-medium block">2.4 MB • Versi 1.1</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">MOU</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 max-w-xs leading-relaxed">
                                Kerjasama Strategis Pengembangan Desa Wisata Kuraitaji
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 flex items-center gap-2">
                                🏢 Disparbud
                            </td>
                            <td class="py-4 px-6 text-center text-xs">
                                <span class="font-bold text-gray-800 block">16 Okt 2023</span>
                                <span class="inline-block mt-0.5 text-gray-400 font-medium text-[10px]">Baru diajukan</span>
                            </td>
                        </tr>

                        <!-- Row 5 -->
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                    PDF
                                </div>
                                <div>
                                    <a href="{{ route('documents.show') }}" class="font-extrabold text-[#061D38] hover:underline block">SE_Penggunaan_Produk_Lokal.pdf</a>
                                    <span class="text-[11px] text-gray-400 font-medium block">1.1 MB • Versi 1.0</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">SURAT_EDARAN</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 max-w-xs leading-relaxed">
                                Peningkatan Penggunaan Produk Dalam Negeri di Lingkungan OPD
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 flex items-center gap-2">
                                🏢 Diskumperindag
                            </td>
                            <td class="py-4 px-6 text-center text-xs">
                                <span class="font-bold text-gray-800 block">17 Okt 2023</span>
                                <span class="inline-block mt-0.5 text-gray-400 font-medium text-[10px]">Baru diajukan</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Menampilkan 1-5 dari 5 dokumen</span>
                <div class="flex items-center gap-1 font-bold">
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-all">‹</button>
                    <button type="button" class="w-7 h-7 rounded-lg bg-[#062447] text-white flex items-center justify-center shadow-xs">1</button>
                    <button type="button" class="w-7 h-7 rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-100 flex items-center justify-center transition-all">›</button>
                </div>
            </div>
        </div>

        <!-- 3. Bottom Alert Box: Panduan Persetujuan -->
        <div class="bg-[#F0F4F8] border border-blue-100 rounded-2xl p-5 flex items-start gap-4">
            <div class="w-9 h-9 rounded-full bg-[#062447] text-white flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-base">
                ℹ
            </div>
            <div>
                <h4 class="font-extrabold text-[#061D38] text-sm">Panduan Persetujuan</h4>
                <p class="text-xs text-gray-600 leading-relaxed mt-1">
                    Pastikan Anda telah memeriksa kesesuaian draf dengan peraturan perundang-undangan yang lebih tinggi sebelum memberikan persetujuan. Gunakan fitur <span class="font-bold text-gray-900">Minta Revisi</span> jika terdapat penulisan atau konten yang kurang tepat agar pengaju dapat segera memperbaiki draf tersebut.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
