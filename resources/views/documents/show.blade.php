<x-app-layout>
    <div class="space-y-6" x-data="{
        showConfirm: false,
        confirmTitle: '',
        confirmMessage: '',
        confirmForm: null,
        triggerConfirm(title, message, formElement) {
            this.confirmTitle = title;
            this.confirmMessage = message;
            this.confirmForm = formElement;
            this.showConfirm = true;
        },
        executeConfirm() {
            if (this.confirmForm) {
                if (this.confirmForm.submitted) return;
                this.confirmForm.submitted = true;
                this.confirmForm.submit();
            }
        }
    }">
        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold rounded-2xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold rounded-2xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Back Button & Page Title Bar -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-gray-100 pb-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('documents.index') }}" class="p-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-xl font-black text-[#061D38] tracking-tight">Detail Pengajuan Dokumen</h2>
                    <span class="font-mono text-xs font-bold text-gray-400">KODE DOKUMEN: {{ $dokumenId }}</span>
                </div>
            </div>

            <!-- Current Status Badge -->
            <div class="flex items-center gap-2">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">STATUS SAAT INI:</span>
                <span class="px-3.5 py-1.5 bg-[#061D38] text-white text-xs font-extrabold uppercase rounded-full shadow-xs">
                    {{ $latest?->statusDokumen?->status ?? 'Pengajuan' }}
                </span>
            </div>
        </div>

        <!-- Main Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Left Info Panel (Col Span 2) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Document Meta Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
                    <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Informasi Metadata Dokumen</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-semibold text-gray-700">
                        <div>
                            <span class="block text-gray-400 text-[10px] font-extrabold uppercase">SUBJEK PENGAJU:</span>
                            <span class="font-bold text-[#061D38] text-sm block mt-0.5">{{ $latest?->subjek?->nama_subjek ?? '-' }}</span>
                            <span class="text-gray-400 text-xs block">{{ $latest?->subjek?->unit_kerja ?? '-' }}</span>
                        </div>

                        <div>
                            <span class="block text-gray-400 text-[10px] font-extrabold uppercase">JENIS DOKUMEN:</span>
                            <span class="inline-block bg-blue-50 text-[#062447] text-xs font-bold uppercase px-2.5 py-1 rounded-lg border border-blue-100 mt-1">
                                {{ $latest?->jenisDokumen?->jenis_dokumen ?? '-' }}
                            </span>
                        </div>

                        <div class="sm:col-span-2">
                            <span class="block text-gray-400 text-[10px] font-extrabold uppercase">PERIHAL DOKUMEN HUKUM:</span>
                            <p class="text-sm font-bold text-gray-900 mt-1 leading-relaxed bg-gray-50/50 p-3.5 border border-gray-100 rounded-xl">
                                {{ $latest?->perihalDokumen?->perihal_dokumen ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Attached File Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-3">
                    <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Berkas Dokumen Terbaru</h3>
                    
                    @if($latest?->dokumen?->nama_file)
                        <div class="flex items-center justify-between p-4 bg-gray-50/50 border border-gray-100 rounded-xl">
                            <div class="flex items-center gap-3">
                                
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="block text-xs font-extrabold text-gray-900 truncate max-w-xs sm:max-w-sm">
                                            {{ $latest->dokumen->dokumen_judul ?? basename($latest->dokumen->nama_file) }}
                                        </span>
                                        <span class="px-2 py-0.5 bg-blue-100 text-[#062447] text-[10px] font-extrabold rounded-md">
                                            Versi #{{ $latest->dokumen_key }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase block mt-0.5">
                                        Nama File : {{ basename($latest->dokumen->nama_file) }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('documents.download', ['dokumenKey' => $latest->dokumen_key]) }}"
                               class="px-4 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center justify-center text-center gap-1.5">
                                <span>Unduh Berkas</span>
                            </a>
                        </div>
                    @else
                        <p class="text-xs font-medium text-gray-400 italic">Tidak ada berkas terlampir.</p>
                    @endif
                </div>

                <!-- OPD / Desa Resubmit Panel (Appears when status is 3 or 4: File Minta Diperbarui / File Revisi) -->
                @if(Auth::user() && Auth::user()->hasRole(['admin_opd', 'admin_desa', 'super_admin']) && in_array($latest?->status_dokumen_key, [3, 4]))
                    <div class="bg-white rounded-2xl shadow-sm border border-rose-200/80 p-6 space-y-5">
                        <div class="flex items-center gap-2.5 text-rose-800 border-b border-rose-100 pb-3">
                            <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-sm font-extrabold uppercase tracking-wider text-rose-900">Form Kirim Ulang Berkas Perbaikan / Revisi</h3>
                        </div>

                        <p class="text-xs text-rose-900 font-semibold bg-rose-50/80 p-3.5 rounded-xl border border-rose-100/90 leading-relaxed">
                            Dokumen ini memerlukan perbaikan berdasarkan catatan dari Bagian Hukum. Silakan unggah berkas Microsoft Word (.doc / .docx) yang telah diperbaiki di bawah ini.
                        </p>

                        <form action="{{ route('documents.resubmit', ['dokumenId' => $dokumenId]) }}" method="POST" enctype="multipart/form-data" class="space-y-5 pt-1">
                            @csrf
                            <div>
                                <label for="resub_judul" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                                    JUDUL DOKUMEN PERBAIKAN <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="resub_judul" name="judul_file" value="{{ old('judul_file', $latest?->dokumen?->dokumen_judul ?? '') }}" required
                                       placeholder="Masukkan judul dokumen..."
                                       class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                                    UNGGAH BERKAS WORD PERBAIKAN (.DOC / .DOCX) <span class="text-rose-500">*</span>
                                </label>
                                <div id="resub-box-container" class="relative border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center cursor-pointer transition-all bg-slate-50/60 hover:bg-blue-50/30 hover:border-[#062447] group">
                                    <input type="file" name="file_dokumen" id="resub_file" accept=".doc,.docx" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleResubFileSelected(this)">

                                    <div id="resub-default-prompt" class="flex flex-col items-center justify-center gap-2">
                                        <div class="w-12 h-12 rounded-full bg-blue-50 text-[#062447] flex items-center justify-center mb-1 group-hover:scale-105 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        <h4 class="text-xs font-extrabold text-gray-800">
                                            Klik untuk unggah atau seret berkas Word perbaikan ke sini
                                        </h4>
                                        <p class="text-[11px] text-gray-400 font-medium">
                                            Wajib format Microsoft Word (.doc / .docx) • Maksimal 20 MB
                                        </p>
                                    </div>

                                    <div id="resub-success-prompt" class="hidden flex flex-col items-center justify-center gap-1.5 py-1">
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase">
                                            ✓ Berkas Perbaikan Dipilih
                                        </span>
                                        <h4 id="resub-display-filename" class="text-xs font-extrabold text-[#062447] break-all max-w-md mt-1"></h4>
                                        <p id="resub-display-filesize" class="text-[11px] text-emerald-700 font-bold"></p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="resub_catatan" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                                    CATATAN PERBAIKAN
                                </label>
                                <textarea id="resub_catatan" name="catatan" rows="3" placeholder="Jelaskan bagian yang telah diperbaiki..."
                                          class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all resize-none">{{ old('catatan') }}</textarea>
                            </div>

                            <div class="pt-2 flex justify-end">
                                <button type="button"
                                        @click="triggerConfirm('Konfirmasi Kirim Berkas Perbaikan', 'Apakah Anda yakin berkas perbaikan ini sudah sesuai dan siap dikirim ulang?', $el.closest('form'))"
                                        class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                                    <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    <span>Kirim Ulang Berkas Perbaikan</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <script>
                    function handleResubFileSelected(input) {
                        const container = document.getElementById('resub-box-container');
                        const defaultPrompt = document.getElementById('resub-default-prompt');
                        const successPrompt = document.getElementById('resub-success-prompt');
                        const nameDisplay = document.getElementById('resub-display-filename');
                        const sizeDisplay = document.getElementById('resub-display-filesize');

                        if (input.files && input.files.length > 0) {
                            const file = input.files[0];
                            nameDisplay.textContent = file.name;
                            sizeDisplay.textContent = 'Ukuran Berkas: ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';
                            
                            defaultPrompt.classList.add('hidden');
                            successPrompt.classList.remove('hidden');
                            
                            container.classList.remove('border-slate-300', 'bg-slate-50/60');
                            container.classList.add('border-emerald-500', 'bg-emerald-50/60');
                        }
                    }
                    </script>
                @endif

                <!-- Verifier Action Form Panels -->
                @if(Auth::user() && Auth::user()->hasRole('admin_hukum') && in_array($latest?->status_dokumen_key, [1, 2, 3]))
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
                        <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Panel Tindakan Verifikator Hukum</h3>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            @if(in_array($latest?->status_dokumen_key, [1, 2]))
                                <form action="{{ route('documents.approve', ['dokumenId' => $dokumenId]) }}" method="POST">
                                    @csrf
                                    <button type="button"
                                            @click="triggerConfirm('Konfirmasi Persetujuan Admin Hukum', 'Apakah Anda yakin ingin menyetujui dokumen ini dan meneruskannya ke Kabag Hukum?', $el.closest('form'))"
                                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                        Setujui &amp; Teruskan ke Kabag
                                    </button>
                                </form>

                                <a href="{{ route('documents.revision', ['id' => $dokumenId]) }}" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                    Minta Revisi ke OPD
                                </a>
                            @endif

                            @if($latest?->status_dokumen_key == 3)
                                <form action="{{ route('documents.forwardRevision', ['dokumenId' => $dokumenId]) }}" method="POST">
                                    @csrf
                                    <button type="button"
                                            @click="triggerConfirm('Konfirmasi Teruskan Catatan Revisi', 'Apakah Anda yakin ingin meneruskan catatan revisi Kabag Hukum ke OPD pengaju?', $el.closest('form'))"
                                            class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                        Teruskan Catatan Revisi ke OPD
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif

                @if(Auth::user() && Auth::user()->hasRole('kabag_hukum') && $latest?->status_dokumen_key == 5)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
                        <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Panel Keputusan Kepala Bagian Hukum</h3>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            <form action="{{ route('documents.approve', ['dokumenId' => $dokumenId]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        @click="triggerConfirm('Konfirmasi Persetujuan Kabag Hukum', 'Apakah Anda yakin ingin memberikan persetujuan final (ST06) pada dokumen hukum ini?', $el.closest('form'))"
                                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                    Setujui Dokumen Final
                                </button>
                            </form>

                            <a href="{{ route('documents.revision', ['id' => $dokumenId]) }}" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                Kembalikan Revisi ke Admin Hukum
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Timeline Panel (Col Span 1) -->
            <!-- FIX: sticky + max-height + internal scroll, jadi panel ini tidak "menjulur" ke bawah
                 lebih panjang dari kolom kiri walau riwayatnya banyak. Ia ikut nempel saat discroll,
                 dan listnya sendiri yang scroll di dalam card. -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 flex flex-col lg:sticky lg:top-6 lg:max-h-[calc(100vh-3rem)]">
                <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2 flex-shrink-0">
                    Riwayat Alur Proses
                    @if($history && $history->isNotEmpty())
                        <span class="ml-1 text-gray-300 normal-case font-bold">({{ $history->count() }})</span>
                    @endif
                </h3>

                @if($history && $history->isNotEmpty())
                    <div class="mt-4 space-y-4 relative overflow-y-auto pr-1 pb-1
                                before:absolute before:top-0 before:bottom-0 before:left-3.5 before:w-0.5 before:bg-gray-100">
                        @foreach($history as $item)
                            <div class="relative pl-8 space-y-1">
                                <div class="absolute left-0 top-1 w-7 h-7 rounded-full bg-[#061D38] text-white flex items-center justify-center text-[10px] font-bold">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="bg-gray-50/70 p-3.5 border border-gray-100 rounded-xl space-y-2">
                                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase">{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</span>
                                    <span class="block text-xs font-extrabold text-[#061D38]">{{ $item->statusDokumen?->status ?? '-' }}</span>
                                    
                                    @if($item->catatan_dokumen)
                                        <p class="text-[11px] font-semibold text-amber-900 bg-amber-50/80 p-2.5 rounded-lg border border-amber-200/80 leading-relaxed">
                                            Catatan: {{ $item->catatan_dokumen }}
                                        </p>
                                    @endif

                                    <!-- Lampiran Berkas Revisi / Markup jika ada pada tahap ini -->
                                    @if($item->dokumen && $item->dokumen->nama_file)
                                        <div class="pt-1">
                                            <a href="{{ route('documents.download', ['dokumenKey' => $item->dokumen_key]) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-[#062447] text-[11px] font-extrabold rounded-lg border border-blue-200/80 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>Unduh Berkas Tahap Ini</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-4 text-xs font-medium text-gray-400 italic">Belum ada alur riwayat.</p>
                @endif
            </div>
        </div>

        <!-- Custom Confirmation Modal (Alpine.js) -->
        <div x-show="showConfirm" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-5 border border-gray-100 text-center">
                <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto border border-amber-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <div class="space-y-1">
                    <h3 class="text-base font-extrabold text-[#061D38]" x-text="confirmTitle"></h3>
                    <p class="text-xs font-semibold text-gray-500 leading-relaxed" x-text="confirmMessage"></p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" @click="showConfirm = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="button" @click="executeConfirm()" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md transition-all cursor-pointer">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>