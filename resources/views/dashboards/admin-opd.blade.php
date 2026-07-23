<!-- Admin OPD / Desa Dynamic Dashboard -->
@php
    $user = Auth::user();
    $subjekService = app(\App\Services\SubjekService::class);
    $subjek = $subjekService->findOrCreateForUser($user);

    // Ambil id_fact terbaru untuk setiap thread dokumen milik subjek/unit kerja ini
    $opdDokumenIds = \App\Models\PengajuanDokumen::where('subjek_key', $subjek->subjek_key)->pluck('dokumen_id')->unique();
    $latestIds = \App\Models\PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
        ->whereIn('dokumen_id', $opdDokumenIds)
        ->groupBy('dokumen_id');

    $myDocs = \App\Models\PengajuanDokumen::with([
        'dokumen', 
        'jenisDokumen', 
        'perihalDokumen', 
        'statusDokumen', 
        'statusPengajuan'
    ])->whereIn('id_fact', $latestIds)->orderBy('id_fact', 'desc')->get();

    $totalDokumen = $myDocs->count();
    $sedangDireview = $myDocs->reject(function($doc) {
        return $doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4 || $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
    })->count();
    $disetujuiCount = $myDocs->filter(function($doc) {
        return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3;
    })->count();
    $perluRevisi = $myDocs->filter(function($doc) {
        return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
    })->count();
    $latestSubmissions = $myDocs->take(5);

    $roleTitle = $user->hasRole('admin_desa') ? 'Petugas / Admin Desa' : 'Admin Unit Kerja / OPD';
@endphp

<div class="space-y-6">
    <!-- 1. Top Welcome Banner & Ajukan Dokumen Baru Card -->
    <div class="flex flex-col lg:flex-row items-stretch justify-between gap-6">
        <!-- Left Welcome Header -->
        <div class="flex-1 flex flex-col justify-center">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-md bg-blue-100 text-[#061D38] text-[10px] font-extrabold uppercase tracking-wider">
                    {{ $userSubjek->unit_kerja ?? $subjek->unit_kerja ?? $roleTitle }}
                </span>
            </div>
            <h1 class="text-2xl font-extrabold text-[#061D38] tracking-tight mt-1.5">
                Selamat Datang, {{ $user->name }}
            </h1>
            <p class="text-xs text-gray-500 font-medium leading-relaxed mt-1 max-w-2xl">
                Kelola penyusunan regulasi dan dokumen hukum instansi Anda secara digital. Pantau status pengajuan secara real-time dari panel ini.
            </p>
        </div>

        <!-- Right Ajukan Dokumen Baru CTA Box -->
        <a href="{{ route('documents.create') }}" class="w-full lg:w-[320px] bg-[#062447] text-white p-5 rounded-2xl shadow-md hover:shadow-lg transition-all flex items-center justify-between cursor-pointer group">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center text-white group-hover:scale-105 transition-all">
                    <svg class="w-6 h-6 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2H7a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-base text-white tracking-tight leading-tight">Ajukan Dokumen</h3>
                    <span class="font-bold text-base text-white tracking-tight leading-tight">Baru</span>
                </div>
            </div>
        </a>
    </div>

    <!-- 2. 4 KPI Summary Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Dokumen Saya -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v1a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DOKUMEN SAYA</h4>
                <p class="text-3xl font-black text-[#061D38] mt-0.5 tracking-tight">{{ number_format($totalDokumen) }}</p>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI</h4>
                <p class="text-3xl font-black text-emerald-600 mt-0.5 tracking-tight">{{ number_format($disetujuiCount) }}</p>
            </div>
        </div>

        <!-- Sedang Direview -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">SEDANG DIREVIEW</h4>
                <p class="text-3xl font-black text-amber-600 mt-0.5 tracking-tight">{{ number_format($sedangDireview) }}</p>
            </div>
        </div>

        <!-- Perlu Revisi -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PERLU REVISI</h4>
                <p class="text-3xl font-black text-rose-600 mt-0.5 tracking-tight">{{ number_format($perluRevisi) }}</p>
            </div>
        </div>
    </div>

    <!-- 3. Daftar Pengajuan Terakhir Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-base font-extrabold text-[#061D38]">Daftar Pengajuan Terakhir</h3>
            </div>
            <a href="{{ route('documents.index') }}" class="text-xs font-bold text-[#061D38] hover:underline flex items-center gap-1">
                Lihat Semua Dokumen →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="py-3.5 px-6">ID THREAD</th>
                        <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                        <th class="py-3.5 px-6">TANGGAL KIRIM</th>
                        <th class="py-3.5 px-4 text-center">STATUS</th>
                        <th class="py-3.5 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    @forelse($latestSubmissions as $row)
                        @php
                            $stKey = $row->status_pengajuan_key;
                            $docStKey = $row->status_dokumen_key;
                            $statusLabel = $row->statusPengajuan->status ?? 'Pengajuan';
                            $badgeClass = 'bg-amber-50 text-amber-700';

                            if ($docStKey == 6 || ($stKey == 4 && $docStKey != 3)) {
                                $statusLabel = 'Disetujui Final';
                                $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                            } elseif ($docStKey == 3 || $stKey == 3) {
                                $statusLabel = 'Perlu Revisi';
                                $badgeClass = 'bg-rose-50 text-rose-700 border border-rose-200';
                            } elseif ($docStKey == 5) {
                                $statusLabel = 'Proses Kabag Hukum';
                                $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200';
                            } else {
                                $statusLabel = 'Proses Admin Hukum';
                                $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 text-xs text-gray-500 font-mono font-extrabold">
                                #DOC-{{ str_pad($row->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline text-sm block">
                                    {{ $row->dokumen->dokumen_judul ?? 'Dokumen #' . $row->dokumen_id }}
                                </a>
                                <span class="text-[11px] text-gray-400 font-medium block mt-0.5">
                                    Jenis: {{ $row->jenisDokumen->jenis_dokumen ?? '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                {{ $row->created_at ? $row->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-block {{ $badgeClass }} font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                    {{ strtoupper($statusLabel) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" title="Lihat Detail" class="p-1.5 inline-block text-[#061D38] hover:bg-gray-100 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
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

    <!-- 4. Bottom 2 Cards Grid: Panduan Pengajuan & Pusat Bantuan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Panduan Pengajuan Card (Dark Navy Fill) -->
        <div class="bg-[#062447] text-white rounded-2xl p-7 relative overflow-hidden flex flex-col justify-between shadow-md">
            <div class="relative z-10 max-w-md">
                <h3 class="text-lg font-extrabold text-white">Panduan Pengajuan Dokumen</h3>
                <p class="text-xs text-blue-100 font-medium leading-relaxed mt-2">
                    Masih bingung dengan alur pengajuan dokumen Perda, Perwako, atau Perdes? Pelajari alur verifikasi legal formal Kota Pariaman.
                </p>
                <a href="{{ route('documents.create') }}" class="inline-block mt-6 bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#062447] font-bold text-xs px-5 py-2.5 rounded-xl shadow transition-all">
                    Mulai Pengajuan
                </a>
            </div>
            <!-- Background Book Icon Outline -->
            <div class="absolute -right-4 -bottom-6 opacity-10 pointer-events-none">
                <svg class="w-48 h-48 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <!-- Pusat Bantuan Card (Light Gray/Earthy Fill) -->
        <div class="bg-[#EBEFE6] text-gray-800 rounded-2xl p-7 relative overflow-hidden flex flex-col justify-between shadow-xs">
            <div class="relative z-10 max-w-md">
                <h3 class="text-lg font-extrabold text-[#061D38]">Pusat Bantuan ELDR</h3>
                <p class="text-xs text-gray-600 font-medium leading-relaxed mt-2">
                    Butuh bantuan teknis terkait sistem ELDR atau perbaikan akun? Tim Diskominfo Kota Pariaman siap membantu Anda.
                </p>
                <a href="{{ route('documents.index') }}" class="inline-block mt-6 bg-white border border-[#061D38] hover:bg-[#061D38] hover:text-white text-[#061D38] font-bold text-xs px-5 py-2.5 rounded-xl transition-all shadow-xs">
                    Lihat Dokumen Saya
                </a>
            </div>
            <!-- Background Headset Icon Outline -->
            <div class="absolute -right-4 -bottom-6 opacity-10 pointer-events-none">
                <svg class="w-48 h-48 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                </svg>
            </div>
        </div>
    </div>
</div>
