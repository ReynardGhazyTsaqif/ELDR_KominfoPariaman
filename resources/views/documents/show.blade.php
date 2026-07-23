<x-app-layout>
    <div class="space-y-6">
        <!-- 1. Top Document Detail Card -->
        <div class="bg-white rounded-2xl p-8 shadow-xs border border-gray-100/80">
            <!-- Header Title Row -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-black text-[#061D38] tracking-tight">Detail Dokumen: DRAFT_PERWAKO_SPBE_2024.docx</h2>
                    <p class="text-xs font-mono font-semibold text-gray-400 mt-1">ID Dokumen: #DOC-2023-1014-001</p>
                </div>
                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 font-extrabold px-3 py-1 rounded-full text-xs tracking-wider uppercase flex-shrink-0">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    DIPROSES
                </span>
            </div>

            <!-- Meta Grid (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-b border-gray-100 text-xs">
                <!-- Col 1: Pengirim & Perihal -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">PENGIRIM</span>
                        <h4 class="font-bold text-gray-900 text-sm">Budi Darmawan</h4>
                        <p class="text-gray-500 font-medium mt-0.5">NIP 19850101 201001 1 005</p>
                    </div>

                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">PERIHAL</span>
                        <p class="font-semibold text-gray-800 leading-relaxed">
                            Penyelenggaraan Sistem Pemerintahan Berbasis Elektronik (SPBE) Lingkup Pemerintah Kota Pariaman
                        </p>
                    </div>
                </div>

                <!-- Col 2: Jenis Dokumen & OPD -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">JENIS DOKUMEN</span>
                        <h4 class="font-bold text-gray-900 text-sm">Peraturan Walikota</h4>
                    </div>

                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">ORGANISASI PERANGKAT DAERAH (OPD)</span>
                        <h4 class="font-bold text-gray-900 text-sm">Diskominfo Kota Pariaman</h4>
                    </div>
                </div>

                <!-- Col 3: Tanggal Upload & File Lampiran -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">TANGGAL UPLOAD</span>
                        <h4 class="font-bold text-gray-900 text-sm">14 Okt 2023, 09:15 WIB</h4>
                    </div>

                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">FILE LAMPIRAN</span>
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 flex items-center justify-between hover:bg-slate-100/80 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-xs text-[#061D38] truncate max-w-[150px]">DRAFT_PERWAKO_SPBE_2024.docx</h5>
                                    <span class="text-[10px] text-gray-400 font-medium">Word Document • 1.2 MB</span>
                                </div>
                            </div>
                            <a href="#" class="p-1.5 text-gray-400 hover:text-gray-700 transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Pengirim Box -->
            <div class="mt-6">
                <span class="font-extrabold text-gray-400 uppercase tracking-wider text-xs block mb-2">CATATAN PENGIRIM</span>
                <div class="bg-[#F7F6F2] p-4 rounded-xl text-sm italic text-gray-700 border-l-4 border-gray-300">
                    "Mohon ditelaah kembali untuk pasal 4 dan 7 terkait kewenangan operasional pusat data daerah."
                </div>
            </div>
        </div>

        <!-- 2. Action Button Bar (4 Buttons) -->
        <div class="flex flex-wrap items-center gap-4">
            <!-- Button 1: Setuju -->
            <button type="button" class="px-6 py-3 bg-[#107C41] hover:bg-[#0B6233] text-white font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all cursor-pointer text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>Setuju</span>
            </button>

            <!-- Button 2: Setuju (Upload File) -->
            <button type="button" class="px-6 py-3 bg-white border-2 border-[#107C41] text-[#107C41] hover:bg-emerald-50 font-bold rounded-xl flex items-center gap-2 transition-all cursor-pointer text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Setuju (Upload File)</span>
            </button>

            <!-- Button 3: Revisi -->
            <a href="{{ route('documents.revision') }}" class="px-6 py-3 bg-[#E67E22] hover:bg-[#D35400] text-white font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all cursor-pointer text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Revisi</span>
            </a>

            <!-- Button 4: Revisi (Upload File) -->
            <a href="{{ route('documents.revision') }}" class="px-6 py-3 bg-white border-2 border-[#E67E22] text-[#E67E22] hover:bg-orange-50 font-bold rounded-xl flex items-center gap-2 transition-all cursor-pointer text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Revisi (Upload File)</span>
            </a>
        </div>

        <!-- 3. Bottom Grid: Riwayat Dokumen Audit Trail & Right Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Cols: Riwayat Dokumen (Audit Trail) -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-xs border border-gray-100/80">
                <h3 class="text-base font-extrabold text-[#061D38] mb-6">Riwayat Dokumen (Audit Trail)</h3>

                <div class="relative pl-6 space-y-6 before:absolute before:left-3 before:top-3 before:bottom-3 before:w-0.5 before:bg-gray-200">
                    <!-- Item 1: Latest -->
                    <div class="relative">
                        <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-amber-100 border-2 border-amber-500 text-amber-700 flex items-center justify-center text-xs font-bold">
                            🕒
                        </span>
                        <div class="bg-[#FDFBF7] border border-amber-200/80 rounded-xl p-5 shadow-xs">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <h4 class="font-bold text-amber-900 text-sm">File Terkirim (Diperbaiki)</h4>
                                <span class="text-gray-400 font-medium">Oct 14, 14:45 WIB</span>
                            </div>
                            <p class="text-xs text-gray-500 font-semibold mb-2">Budi Darmawan • Diskominfo</p>
                            <p class="text-xs text-gray-700 leading-relaxed mb-3">
                                "Sudah diperbaiki sesuai arahan dari tim hukum. Penomoran Bab III telah disesuaikan."
                            </p>
                            <a href="#" class="inline-flex items-center gap-1.5 bg-white border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-bold text-gray-700 hover:bg-gray-50 transition-all">
                                📎 DRAFT_REV_2.docx
                            </a>
                        </div>
                    </div>

                    <!-- Item 2: Revision Requested -->
                    <div class="relative">
                        <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-orange-100 border-2 border-orange-500 text-orange-600 flex items-center justify-center text-xs font-bold">
                            !
                        </span>
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <h4 class="font-bold text-orange-600 text-sm">File Minta Diperbarui</h4>
                                <span class="text-gray-400 font-medium">Oct 14, 11:30 WIB</span>
                            </div>
                            <p class="text-xs text-gray-500 font-semibold mb-2">Admin Hukum • Bagian Hukum</p>
                            <p class="text-xs text-gray-700 leading-relaxed mb-3">
                                "Terdapat kesalahan penomoran pada bab III dan beberapa typo pada pasal 5 ayat 2."
                            </p>
                            <a href="#" class="inline-flex items-center gap-1.5 bg-gray-50 border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-bold text-gray-700 hover:bg-gray-100 transition-all">
                                📄 Catatan_Review_Hukum.pdf
                            </a>
                        </div>
                    </div>

                    <!-- Item 3: Initial Upload -->
                    <div class="relative">
                        <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-gray-100 border-2 border-gray-400 text-gray-600 flex items-center justify-center text-xs font-bold">
                            ☁️
                        </span>
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <h4 class="font-bold text-gray-800 text-sm">File Terkirim</h4>
                                <span class="text-gray-400 font-medium">Oct 14, 09:15 WIB</span>
                            </div>
                            <p class="text-xs text-gray-500 font-semibold mb-2">Budi Darmawan • Diskominfo</p>
                            <p class="text-xs text-gray-700 leading-relaxed">
                                "Draft awal untuk review legalitas operasional SPBE."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Statistik Review & Help Box -->
            <div class="space-y-6">
                <!-- Statistik Review Card -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 space-y-4">
                    <h4 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">STATISTIK REVIEW</h4>

                    <div class="space-y-3 pt-2 text-xs">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-2.5">
                            <span class="font-medium text-gray-500">Waktu Tunggu</span>
                            <span class="font-extrabold text-[#061D38] text-sm">5 Jam 30 Menit</span>
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-2.5">
                            <span class="font-medium text-gray-500">Total Revisi</span>
                            <span class="font-extrabold text-emerald-600 text-sm">1 Kali</span>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <span class="font-medium text-gray-500">SLA Reviewer</span>
                            <span class="bg-emerald-50 text-emerald-700 font-extrabold px-2.5 py-0.5 rounded-full text-[10px] uppercase">NORMAL</span>
                        </div>
                    </div>
                </div>

                <!-- Perlu Bantuan Card -->
                <div class="bg-[#062447] rounded-2xl p-6 text-white shadow-md space-y-3">
                    <h4 class="font-extrabold text-base text-white">Perlu Bantuan?</h4>
                    <p class="text-xs text-blue-100 leading-relaxed">
                        Hubungi tim administrator jika terdapat kendala dalam sistem review atau akses dokumen.
                    </p>
                    <button type="button" class="w-full mt-3 py-2.5 bg-[#755900] hover:bg-[#5E4700] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-xs transition-all cursor-pointer">
                        Kontak Admin
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
