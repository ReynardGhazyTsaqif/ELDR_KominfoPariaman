<x-app-layout>
    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold p-4 rounded-xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold p-4 rounded-xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @php
            $hasData = isset($latest) && $latest !== null;
            $docStKey = $hasData ? $latest->status_dokumen_key : null;
            $stKey = $hasData ? $latest->status_pengajuan_key : null;

            $statusText = $hasData ? ($latest->statusPengajuan->status ?? 'DIPROSES') : 'DIPROSES';
            $statusBadgeBg = 'bg-amber-50 text-amber-800 border-amber-200';
            $statusDotBg = 'bg-amber-500';

            if ($docStKey == 6 || ($stKey == 4 && $docStKey != 3)) {
                $statusText = 'DISETUJUI FINAL';
                $statusBadgeBg = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                $statusDotBg = 'bg-emerald-500';
            } elseif ($docStKey == 3 || $stKey == 3) {
                $statusText = 'PERLU REVISI';
                $statusBadgeBg = 'bg-rose-50 text-rose-800 border-rose-200';
                $statusDotBg = 'bg-rose-500';
            } elseif ($docStKey == 5) {
                $statusText = 'PROSES KABAG HUKUM';
                $statusBadgeBg = 'bg-blue-50 text-blue-800 border-blue-200';
                $statusDotBg = 'bg-blue-500';
            } else {
                $statusText = 'PROSES ADMIN HUKUM';
                $statusBadgeBg = 'bg-amber-50 text-amber-800 border-amber-200';
                $statusDotBg = 'bg-amber-500';
            }

            $judul = $hasData ? ($latest->dokumen->dokumen_judul ?? 'DRAFT_PERWAKO_SPBE_2024.docx') : 'DRAFT_PERWAKO_SPBE_2024.docx';
            $docId = $hasData ? '#DOC-' . str_pad($latest->dokumen_id, 4, '0', STR_PAD_LEFT) : '#DOC-2023-1014-001';
            $pengirim = $hasData ? ($latest->subjek->nama_subjek ?? 'Budi Darmawan') : 'Budi Darmawan';
            $identitas = $hasData ? ($latest->subjek->nomor_identitas ?? '19850101 201001 1 005') : '19850101 201001 1 005';
            $perihal = $hasData ? ($latest->perihalDokumen->perihal_dokumen ?? 'Penyelenggaraan SPBE Lingkup Kota Pariaman') : 'Penyelenggaraan Sistem Pemerintahan Berbasis Elektronik (SPBE) Lingkup Pemerintah Kota Pariaman';
            $jenis = $hasData ? ($latest->jenisDokumen->jenis_dokumen ?? 'Peraturan Walikota') : 'Peraturan Walikota';
            $opd = $hasData ? ($latest->subjek->unit_kerja ?? 'Diskominfo Kota Pariaman') : 'Diskominfo Kota Pariaman';
            $tglUpload = $hasData ? $latest->created_at->format('d M Y, H:i \W\I\B') : '14 Okt 2023, 09:15 WIB';
            $catatan = $hasData ? $latest->catatan_dokumen : 'Mohon ditelaah kembali untuk pasal 4 dan 7 terkait kewenangan operasional pusat data daerah.';
            $dokumenKey = $hasData ? $latest->dokumen_key : null;
        @endphp

        <!-- 1. Top Document Detail Card -->
        <div class="bg-white rounded-2xl p-8 shadow-xs border border-gray-100/80">
            <!-- Header Title Row -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-black text-[#061D38] tracking-tight">Detail Dokumen: {{ $judul }}</h2>
                    <p class="text-xs font-mono font-semibold text-gray-400 mt-1">ID Dokumen: {{ $docId }}</p>
                </div>
                <span class="inline-flex items-center gap-1.5 {{ $statusBadgeBg }} font-extrabold px-3.5 py-1.5 rounded-full text-xs tracking-wider uppercase flex-shrink-0 border shadow-xs">
                    <span class="w-2 h-2 rounded-full {{ $statusDotBg }}"></span>
                    {{ strtoupper($statusText) }}
                </span>
            </div>

            <!-- Meta Grid (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-6 border-b border-gray-100 text-xs">
                <!-- Col 1: Pengirim & Perihal -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">PENGIRIM</span>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $pengirim }}</h4>
                        <p class="text-gray-500 font-medium mt-0.5">ID / NIP: {{ $identitas }}</p>
                    </div>

                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">PERIHAL</span>
                        <p class="font-semibold text-gray-800 leading-relaxed">
                            {{ $perihal }}
                        </p>
                    </div>
                </div>

                <!-- Col 2: Jenis Dokumen & OPD -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">JENIS DOKUMEN</span>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $jenis }}</h4>
                    </div>

                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">ORGANISASI PERANGKAT DAERAH (OPD) / UNIT</span>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $opd }}</h4>
                    </div>
                </div>

                <!-- Col 3: Tanggal Upload & File Lampiran -->
                <div class="space-y-5">
                    <div>
                        <span class="font-extrabold text-gray-400 uppercase tracking-wider block mb-1">TANGGAL UPLOAD</span>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $tglUpload }}</h4>
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
                                    <h5 class="font-bold text-xs text-[#061D38] truncate max-w-[150px]">{{ $judul }}</h5>
                                    <span class="text-[10px] text-gray-400 font-medium">Word Document (.doc / .docx)</span>
                                </div>
                            </div>
                            @if($dokumenKey)
                                <a href="{{ route('documents.download', ['dokumenKey' => $dokumenKey]) }}" class="p-1.5 text-blue-600 hover:text-blue-900 transition-all cursor-pointer" title="Download Document">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            @else
                                <a href="#" class="p-1.5 text-gray-400 hover:text-gray-700 transition-all cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Pengirim Box -->
            @if($catatan)
            <div class="mt-6">
                <span class="font-extrabold text-gray-400 uppercase tracking-wider text-xs block mb-2">CATATAN / KETERANGAN</span>
                <div class="bg-[#F7F6F2] p-4 rounded-xl text-sm italic text-gray-700 border-l-4 border-gray-300">
                    "{{ $catatan }}"
                </div>
            </div>
            @endif
        </div>

        <!-- 1.5. Form Kirim Ulang Berkas Revisi (Hanya tampil untuk OPD/Desa jika status dokumen == Perlu Revisi) -->
        @if($hasData && $latest->status_pengajuan_key == 3 && Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('super_admin')))
        <div class="bg-amber-50 border-2 border-amber-300 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-lg">
                    !
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-amber-900">Dokumen Memerlukan Revisi</h3>
                    <p class="text-xs text-amber-700 font-medium">Unggah berkas perbaikan (.doc / .docx) di bawah ini untuk mengirim ulang revisi pada thread dokumen ini tanpa perlu membuat pengajuan baru.</p>
                </div>
            </div>

            <!-- Display Official Revision Notes from Kabag / Admin Hukum for OPD -->
            @if($latest->catatan_dokumen)
            <div class="bg-white border-l-4 border-amber-500 border-amber-200/80 rounded-xl p-5 shadow-xs space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 bg-amber-100 text-amber-900 font-extrabold text-[10px] uppercase rounded-md border border-amber-300">
                        💬 Catatan Koreksi dari Verifikator (Kabag & Admin Hukum)
                    </span>
                </div>
                <p class="text-sm font-semibold text-gray-800 italic leading-relaxed pt-1">
                    "{{ $latest->catatan_dokumen }}"
                </p>
            </div>
            @endif

            <form action="{{ route('documents.resubmit', ['dokumenId' => $latest->dokumen_id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-3 border-t border-amber-200/80">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-1">Judul Dokumen Perbaikan</label>
                        <input type="text" name="judul_file" value="{{ $judul }}" required class="w-full px-4 py-2.5 bg-white border border-amber-200 rounded-xl text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-1">Berkas Revisi Baru (.DOC / .DOCX)</label>
                        <input type="file" name="file_dokumen" accept=".doc,.docx" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#062447] file:text-white hover:file:bg-[#0A3363]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-amber-900 uppercase tracking-wider mb-1">Catatan Perbaikan (Opsional)</label>
                    <textarea name="catatan" rows="2" placeholder="Jelaskan poin-poin yang sudah Anda perbaiki sesuai catatan verifikator..." class="w-full px-4 py-2 bg-white border border-amber-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Kirim Ulang Berkas Revisi</span>
                    </button>
                </div>
            </form>
        </div>
        @endif

        @php
            $adminHukumEverApproved = false;
            if (isset($history) && count($history) > 0) {
                foreach ($history as $h) {
                    if ($h->status_dokumen_key == 5 || str_contains(strtolower($h->keterangan ?? ''), 'disetujui admin hukum')) {
                        $adminHukumEverApproved = true;
                    }
                }
            }

            $isKabagRevisionPending = $hasData && $latest->status_dokumen_key == 3 && (
                $adminHukumEverApproved || 
                $latest->status_pengajuan_key == 2 || 
                str_contains(strtolower($latest->keterangan ?? ''), 'kabag') ||
                ($latest->subjek && str_contains(strtolower($latest->subjek->nama_subjek ?? ''), 'kabag'))
            );
        @endphp

        <!-- 1.6. Hero Banner Teruskan Revisi Kabag Hukum ke OPD -->
        @if($isKabagRevisionPending && Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('super_admin')))
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-400 rounded-2xl p-7 shadow-md space-y-5 relative overflow-hidden">
            <!-- Header Row -->
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center font-black text-xl shadow-xs flex-shrink-0">
                        !
                    </div>
                    <div>
                        <span class="bg-purple-100 text-purple-800 font-extrabold text-[10px] uppercase px-2.5 py-0.5 rounded-md border border-purple-200">
                            Permintaan Revisi dari Kabag Hukum
                        </span>
                        <h3 class="text-lg font-black text-[#061D38] tracking-tight mt-1">Teruskan Pesan Revisi Kabag Hukum ke OPD / Desa</h3>
                        <p class="text-xs text-gray-600 font-medium mt-0.5">Kabag Hukum meminta koreksi dokumen ini. Silakan periksa pesan Kabag di bawah dan klik tombol teruskan ke OPD.</p>
                    </div>
                </div>
            </div>

            <!-- Box Catatan Kabag Hukum -->
            @if($latest->catatan_dokumen)
            <div class="bg-white border-l-4 border-amber-500 border-gray-200/80 rounded-xl p-5 shadow-xs space-y-1.5">
                <span class="text-[10px] font-extrabold text-amber-700 uppercase tracking-wider block">💬 Pesan & Catatan Revisi dari Kabag Hukum:</span>
                <p class="text-sm font-semibold text-gray-800 italic leading-relaxed">
                    "{{ $latest->catatan_dokumen }}"
                </p>
            </div>
            @endif

            <!-- Hero Box Footer info -->
            <div class="pt-2 border-t border-amber-200 text-xs text-amber-900 font-bold flex items-center gap-1.5">
                <span>ℹ️ Gunakan tombol "Teruskan Catatan Revisi Kabag ke OPD" di bawah untuk meneruskan koreksi ini ke OPD/Desa</span>
            </div>
        </div>
        @endif

        <!-- 2. Combined Action Button Bar (For Admin/Kabag Hukum) -->
        @if(Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum') || Auth::user()->hasRole('super_admin')))
        <div class="flex flex-wrap items-center gap-4">
            @if($isKabagRevisionPending && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('super_admin')))
                <button type="button" onclick="openForwardModal()" class="px-6 py-3 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-xl flex items-center gap-2.5 shadow-sm transition-all cursor-pointer text-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#F5BF38] animate-ping"></span>
                    <span>📩 Teruskan Catatan Revisi Kabag ke OPD</span>
                </button>
            @endif

            <!-- Button 1: Setuju Dokumen -->
            @if($hasData)
                <form action="{{ route('documents.approve', ['dokumenId' => $latest->dokumen_id]) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyetujui dokumen ini?')" class="px-6 py-3 bg-[#107C41] hover:bg-[#0B6233] text-white font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all cursor-pointer text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Setuju Dokumen</span>
                    </button>
                </form>
            @else
                <button type="button" class="px-6 py-3 bg-[#107C41] hover:bg-[#0B6233] text-white font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all cursor-pointer text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Setuju Dokumen</span>
                </button>
            @endif

            <!-- Button 2: Minta Revisi -->
            <a href="{{ route('documents.revision', ['id' => $dokumenId ?? $latest->dokumen_id ?? 1]) }}" class="px-6 py-3 bg-[#E67E22] hover:bg-[#D35400] text-white font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all cursor-pointer text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Minta Revisi Baru</span>
            </a>
        </div>
        @endif

        <!-- Modal Teruskan Catatan Revisi Kabag ke OPD -->
        <div id="forwardRevisionModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-5 border border-gray-100 transform transition-all">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-black">
                            📩
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-[#061D38]">Teruskan Catatan Revisi Kabag ke OPD</h3>
                            <p class="text-[11px] text-gray-500 font-medium">Kirimkan catatan resmi Kabag Hukum agar OPD dapat memperbaiki dokumen</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeForwardModal()" class="text-gray-400 hover:text-gray-600 font-bold text-lg p-1">✕</button>
                </div>

                <!-- Box Pesan Asli dari Kabag Hukum -->
                <div class="bg-purple-50 border-l-4 border-purple-600 rounded-xl p-4 space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-purple-200 text-purple-900 font-black text-[9px] uppercase rounded">Pesan & Catatan Asli dari Kabag Hukum</span>
                    </div>
                    <p class="text-xs font-bold text-purple-950 italic mt-1 leading-relaxed">
                        "{{ $latest->catatan_dokumen ?? 'Permintaan Revisi oleh Kabag Hukum' }}"
                    </p>
                </div>

                <!-- Form Teruskan -->
                <form action="{{ route('documents.forwardRevision', ['dokumenId' => $latest->dokumen_id]) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Catatan Tambahan Admin Hukum (Opsional)</label>
                        <textarea name="catatan_tambahan" rows="3" placeholder="Tambahkan instruksi teknis dari Admin Hukum untuk OPD jika diperlukan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none font-medium"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" onclick="closeForwardModal()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition-all">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold rounded-xl text-xs uppercase tracking-wider shadow-md transition-all flex items-center gap-2">
                            <span>🚀 Teruskan ke OPD</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openForwardModal() {
                document.getElementById('forwardRevisionModal').classList.remove('hidden');
            }
            function closeForwardModal() {
                document.getElementById('forwardRevisionModal').classList.add('hidden');
            }
        </script>

        <!-- 3. Bottom Grid: Riwayat Dokumen Audit Trail & Right Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Cols: Riwayat Dokumen (Audit Trail) -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-xs border border-gray-100/80">
                <h3 class="text-base font-extrabold text-[#061D38] mb-6">Riwayat Dokumen (Audit Trail)</h3>

                <div class="relative pl-6 space-y-6 before:absolute before:left-3 before:top-3 before:bottom-3 before:w-0.5 before:bg-gray-200">
                    @if(isset($history) && count($history) > 0)
                        @php
                            // Chronological analysis to accurately resolve roles even for legacy data
                            $historyProcessed = [];
                            $adminHukumApprovedYet = false;

                            foreach ($history as $hItem) {
                                $ket = $hItem->keterangan ?? $hItem->statusDokumen->status ?? '';
                                $stDocKey = $hItem->status_dokumen_key;
                                $rawActorName = $hItem->subjek->nama_subjek ?? 'Petugas';
                                $rawUnitKerja = $hItem->subjek->unit_kerja ?? '-';

                                $roleLabel = 'OPD / Desa';
                                $roleBg = 'bg-slate-100 text-slate-700 border-slate-200';
                                $actorDisplay = $rawActorName;
                                $unitDisplay = $rawUnitKerja;

                                if (str_contains(strtolower($ket), 'kabag') || $stDocKey == 6) {
                                    $roleLabel = 'Kabag Hukum';
                                    $roleBg = 'bg-purple-100 text-purple-800 border-purple-200';
                                    if (str_contains(strtolower($rawActorName), 'diskominfo') || str_contains(strtolower($rawActorName), 'opd') || str_contains(strtolower($rawActorName), 'petugas')) {
                                        $actorDisplay = 'Kabag Hukum';
                                        $unitDisplay = 'Bagian Hukum Sekretariat Daerah';
                                    }
                                } elseif (str_contains(strtolower($ket), 'admin hukum') || $stDocKey == 5) {
                                    $roleLabel = 'Admin Hukum';
                                    $roleBg = 'bg-blue-100 text-blue-800 border-blue-200';
                                    $adminHukumApprovedYet = true;
                                    if (str_contains(strtolower($rawActorName), 'diskominfo') || str_contains(strtolower($rawActorName), 'opd') || str_contains(strtolower($rawActorName), 'petugas')) {
                                        $actorDisplay = 'Staf Bagian Hukum';
                                        $unitDisplay = 'Bagian Hukum Sekretariat Daerah';
                                    }
                                } elseif ($stDocKey == 3 || $stDocKey == 4) {
                                    // Revision action: If Admin Hukum has approved previously in thread, this revision comes from Kabag Hukum!
                                    if ($adminHukumApprovedYet || str_contains(strtolower($ket), 'kabag')) {
                                        $roleLabel = 'Kabag Hukum';
                                        $roleBg = 'bg-purple-100 text-purple-800 border-purple-200';
                                        if (str_contains(strtolower($rawActorName), 'diskominfo') || str_contains(strtolower($rawActorName), 'opd') || str_contains(strtolower($rawActorName), 'petugas')) {
                                            $actorDisplay = 'Kabag Hukum';
                                            $unitDisplay = 'Bagian Hukum Sekretariat Daerah';
                                        }
                                    } else {
                                        $roleLabel = 'Admin Hukum';
                                        $roleBg = 'bg-blue-100 text-blue-800 border-blue-200';
                                        if (str_contains(strtolower($rawActorName), 'diskominfo') || str_contains(strtolower($rawActorName), 'opd') || str_contains(strtolower($rawActorName), 'petugas')) {
                                            $actorDisplay = 'Staf Bagian Hukum';
                                            $unitDisplay = 'Bagian Hukum Sekretariat Daerah';
                                        }
                                    }
                                } else {
                                    $roleLabel = 'Pengaju (' . ($rawUnitKerja !== '-' ? $rawUnitKerja : 'OPD/Desa') . ')';
                                    $roleBg = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                                }

                                $historyProcessed[] = (object)[
                                    'item' => $hItem,
                                    'roleLabel' => $roleLabel,
                                    'roleBg' => $roleBg,
                                    'actorDisplay' => $actorDisplay,
                                    'unitDisplay' => $unitDisplay,
                                    'ket' => $ket
                                ];
                            }
                        @endphp

                        @foreach(array_reverse($historyProcessed) as $p)
                            @php
                                $item = $p->item;
                            @endphp
                            <div class="relative">
                                @if($item->status_dokumen_key == 6)
                                    <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-emerald-100 border-2 border-emerald-500 text-emerald-700 flex items-center justify-center text-xs font-bold">✓</span>
                                @elseif($item->status_dokumen_key == 3 || $item->status_dokumen_key == 4)
                                    <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-orange-100 border-2 border-orange-500 text-orange-600 flex items-center justify-center text-xs font-bold">!</span>
                                @else
                                    <span class="absolute -left-6 top-1 w-6 h-6 rounded-full bg-blue-100 border-2 border-blue-500 text-blue-700 flex items-center justify-center text-xs font-bold">🕒</span>
                                @endif
                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs space-y-2">
                                    <div class="flex flex-wrap items-center justify-between gap-2 text-xs">
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-bold text-[#061D38] text-sm">{{ $p->ket }}</h4>
                                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase border {{ $p->roleBg }}">
                                                {{ $p->roleLabel }}
                                            </span>
                                        </div>
                                        <span class="text-gray-400 font-medium">{{ $item->created_at->format('M d, Y • H:i \W\I\B') }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 font-semibold">Pelaku Aksi: {{ $p->actorDisplay }} ({{ $p->unitDisplay }})</p>
                                    @if($item->catatan_dokumen)
                                        <div class="bg-gray-50 p-3 rounded-lg border-l-2 border-amber-400">
                                            <p class="text-xs text-gray-700 italic leading-relaxed">
                                                "{{ $item->catatan_dokumen }}"
                                            </p>
                                        </div>
                                    @endif
                                    @if($item->dokumen_key)
                                        <a href="{{ route('documents.download', ['dokumenKey' => $item->dokumen_key]) }}" class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-bold text-blue-700 hover:bg-slate-100 transition-all">
                                            📎 {{ $item->dokumen->dokumen_judul ?? 'Download Berkas' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Sample Item 1: Latest -->
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
                                <span class="inline-flex items-center gap-1.5 bg-white border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-bold text-gray-700">
                                    📎 DRAFT_REV_2.docx
                                </span>
                            </div>
                        </div>

                        <!-- Sample Item 2 -->
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
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right 1 Col: Statistik Review & Help Box -->
            <div class="space-y-6">
                <!-- Statistik Review Card -->
                <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 space-y-4">
                    <h4 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">STATISTIK REVIEW</h4>

                    <div class="space-y-3 pt-2 text-xs">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-2.5">
                            <span class="font-medium text-gray-500">Status Pengajuan</span>
                            <span class="font-extrabold text-[#061D38] text-sm">{{ strtoupper($statusText) }}</span>
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-100 pb-2.5">
                            <span class="font-medium text-gray-500">Total Riwayat Aksi</span>
                            <span class="font-extrabold text-emerald-600 text-sm">{{ isset($history) ? count($history) : 1 }} Kali</span>
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
                    <a href="mailto:diskominfo@pariamankota.go.id" class="w-full mt-3 py-2.5 bg-[#755900] hover:bg-[#5E4700] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-xs transition-all flex items-center justify-center gap-2">
                        Kontak Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
