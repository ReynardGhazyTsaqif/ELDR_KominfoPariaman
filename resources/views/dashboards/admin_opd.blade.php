<div class="space-y-6">
    <!-- Hero Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 py-2">
        <div class="space-y-1.5 max-w-2xl">
            <h1 class="text-3xl font-extrabold tracking-tight text-[#062447]">
                Selamat Datang, {{ $user->name }}
            </h1>
            <p class="text-sm text-gray-500 font-medium leading-relaxed">
                Kelola penyusunan regulasi dan dokumen hukum Anda secara digital. Pantau status pengajuan secara real-time dari panel ini.
            </p>
        </div>

        <!-- CTA Button Top Right -->
        <div class="flex-shrink-0">
            <a href="{{ route('documents.create') }}" class="px-6 py-4 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl shadow-md transition-all flex items-center gap-3 cursor-pointer">
                <div class="w-7 h-7 rounded-lg bg-[#0B1E36] text-[#FFC72C] flex items-center justify-center font-black text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span>Ajukan Dokumen Baru</span>
            </a>
        </div>
    </div>

    <!-- 3 Summary Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- 1. DOKUMEN SAYA -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-[#EEF2FF] text-[#4F46E5] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v1a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">DOKUMEN SAYA</h4>
                <p class="text-3xl sm:text-4xl font-black text-[#062447] tracking-tight mt-0.5">{{ number_format($totalCount) }}</p>
            </div>
        </div>

        <!-- 2. SEDANG DIREVIEW -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">SEDANG DIREVIEW</h4>
                <p class="text-3xl sm:text-4xl font-black text-[#062447] tracking-tight mt-0.5">{{ number_format($diprosesCount) }}</p>
            </div>
        </div>

        <!-- 3. PERLU REVISI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-[#FEE2E2] text-[#DC2626] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">PERLU REVISI</h4>
                <p class="text-3xl sm:text-4xl font-black text-[#DC2626] tracking-tight mt-0.5">{{ number_format($ditolakCount) }}</p>
            </div>
        </div>
    </div>

    <!-- Table Card: Daftar Pengajuan Terakhir -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <!-- Table Header Bar -->
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <h3 class="text-base font-extrabold text-[#062447]">Daftar Pengajuan Terakhir</h3>
            </div>
            <a href="{{ route('documents.index') }}" class="text-xs font-bold text-[#062447] hover:underline flex items-center gap-1.5">
                <span>Lihat Semua</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Table Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        <th class="py-4 px-6">ID TIKET</th>
                        <th class="py-4 px-6">NAMA DOKUMEN</th>
                        <th class="py-4 px-6">TANGGAL KIRIM</th>
                        <th class="py-4 px-6 text-center">STATUS</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                    @forelse($recentDocuments as $doc)
                        @php
                            $stKey = $doc->status_pengajuan_key;
                            $docStKey = $doc->status_dokumen_key;
                            
                            if ($docStKey == 6 || ($stKey == 4 && $docStKey != 3)) {
                                $statusLabel = 'SELESAI';
                                $badgeClass = 'bg-[#DCFCE7] text-[#15803D]';
                                $iconSymbol = '●';
                            } elseif ($docStKey == 3 || $stKey == 3) {
                                $statusLabel = 'PERLU REVISI';
                                $badgeClass = 'bg-[#FEE2E2] text-[#991B1B]';
                                $iconSymbol = '⚠️';
                            } elseif ($docStKey == 5) {
                                $statusLabel = 'REVIEW KABAG';
                                $badgeClass = 'bg-[#DBEAFE] text-[#1E40AF]';
                                $iconSymbol = '●';
                            } elseif ($docStKey == 1) {
                                $statusLabel = 'DRAFT';
                                $badgeClass = 'bg-[#F3F4F6] text-[#4B5563]';
                                $iconSymbol = '●';
                            } else {
                                $statusLabel = 'REVIEW AHLI';
                                $badgeClass = 'bg-[#DBEAFE] text-[#1E40AF]';
                                $iconSymbol = '●';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-mono text-xs font-semibold text-gray-400 leading-tight">
                                <div>ELDR - 2023 -</div>
                                <div>{{ str_pad($doc->dokumen_id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-sm text-[#062447] hover:underline block leading-snug">
                                    {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                </a>
                                <span class="text-xs text-gray-500 font-normal block mt-1">
                                    Jenis: {{ $doc->jenisDokumen->jenis_dokumen ?? 'Peraturan' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">
                                {{ $doc->created_at ? $doc->created_at->format('d Okt Y') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-block {{ $badgeClass }} font-extrabold px-3.5 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                    {{ $iconSymbol }} {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if($docStKey == 3 || $stKey == 3 || $docStKey == 1)
                                        <a href="{{ route('documents.revision', ['id' => $doc->dokumen_id]) }}" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Edit Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="p-2 text-[#062447] hover:bg-gray-100 rounded-lg transition-all" title="Detail Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm font-bold text-gray-600">Belum ada pengajuan dokumen</p>
                                    <p class="text-xs text-gray-400">Klik tombol "Ajukan Dokumen Baru" untuk memulai pengajuan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom 2-Column Banner Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card 1: Panduan Pengajuan -->
        <div class="bg-[#062447] text-white rounded-2xl p-8 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[200px]">
            <div class="space-y-2 max-w-sm relative z-10">
                <h3 class="text-2xl font-bold tracking-tight text-white">Panduan Pengajuan</h3>
                <p class="text-xs text-blue-100/80 leading-relaxed">
                    Masih bingung dengan alur pengajuan dokumen? Pelajari langkah-langkahnya di modul panduan kami.
                </p>
            </div>
            
            <div class="mt-6 relative z-10">
                <a href="#" class="inline-block px-6 py-3 bg-[#FFC72C] hover:bg-[#E5B224] text-[#062447] font-black text-xs rounded-xl shadow-xs transition-all cursor-pointer">
                    Baca Selengkapnya
                </a>
            </div>

            <!-- Subtle background book icon -->
            <div class="absolute -right-4 -bottom-6 text-white/5 pointer-events-none">
                <svg class="w-44 h-44" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Pusat Bantuan -->
        <div class="bg-[#EAECEF] text-gray-800 rounded-2xl p-8 shadow-2xs border border-gray-200/80 relative overflow-hidden flex flex-col justify-between min-h-[200px]">
            <div class="space-y-2 max-w-sm relative z-10">
                <h3 class="text-2xl font-bold tracking-tight text-[#062447]">Pusat Bantuan</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Butuh bantuan teknis terkait sistem ELDR? Tim support kami siap membantu Anda.
                </p>
            </div>

            <div class="mt-6 relative z-10">
                <a href="mailto:diskominfo@pariamankota.go.id" class="inline-block px-6 py-3 bg-white border border-gray-400 hover:bg-gray-50 text-[#062447] font-extrabold text-xs rounded-xl shadow-xs transition-all cursor-pointer">
                    Hubungi Admin
                </a>
            </div>

            <!-- Subtle background headset icon -->
            <div class="absolute -right-4 -bottom-6 text-gray-400/20 pointer-events-none">
                <svg class="w-44 h-44" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                </svg>
            </div>
        </div>
    </div>
</div>
