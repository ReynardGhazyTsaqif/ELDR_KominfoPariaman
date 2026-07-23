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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
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
                                {{ $latest?->perihalDokumen?->perihal ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Attached File Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-3">
                    <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Berkas Fisik Dokumen</h3>
                    
                    @if($latest?->dokumen?->file_path)
                        <div class="flex items-center justify-between p-4 bg-gray-50/50 border border-gray-100 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 text-[#061D38] rounded-xl flex items-center justify-center font-bold text-xs">
                                    DOC
                                </div>
                                <div>
                                    <span class="block text-xs font-extrabold text-gray-900 truncate max-w-xs sm:max-w-sm">{{ basename($latest->dokumen->file_path) }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Tipe: {{ pathinfo($latest->dokumen->file_path, PATHINFO_EXTENSION) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('documents.download', ['id' => $latest->id_fact]) }}"
                               class="px-4 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-xs transition-all">
                                Unduh File
                            </a>
                        </div>
                    @else
                        <p class="text-xs font-medium text-gray-400 italic">Tidak ada berkas terlampir.</p>
                    @endif
                </div>

                <!-- Verifier Action Form Panels -->
                @if(Auth::user() && Auth::user()->hasRole('admin_hukum') && in_array($latest?->status_dokumen_key, [1, 2, 3]))
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
                        <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Panel Tindakan Verifikator Hukum</h3>
                        
                        <div class="flex flex-wrap items-center gap-3">
                            @if(in_array($latest?->status_dokumen_key, [1, 2]))
                                <form action="{{ route('documents.approveByAdminHukum', ['dokumenId' => $dokumenId]) }}" method="POST">
                                    @csrf
                                    <button type="button"
                                            @click="triggerConfirm('Konfirmasi Persetujuan Admin Hukum', 'Apakah Anda yakin ingin menyetujui dokumen ini dan meneruskannya ke Kabag Hukum?', $el.closest('form'))"
                                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                        Setujui &amp; Teruskan ke Kabag
                                    </button>
                                </form>
                            @endif

                            @if($latest?->status_dokumen_key == 3)
                                <form action="{{ route('documents.forwardRevisionToOpd', ['dokumenId' => $dokumenId]) }}" method="POST">
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
                            <form action="{{ route('documents.approveByKabag', ['dokumenId' => $dokumenId]) }}" method="POST">
                                @csrf
                                <button type="button"
                                        @click="triggerConfirm('Konfirmasi Persetujuan Kabag Hukum', 'Apakah Anda yakin ingin memberikan persetujuan final (ST06) pada dokumen hukum ini?', $el.closest('form'))"
                                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl transition-all shadow-md cursor-pointer">
                                    Setujui Dokumen Final (ST06)
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Timeline Panel (Col Span 1) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
                <h3 class="text-sm font-extrabold text-[#061D38] uppercase tracking-wider border-b border-gray-100 pb-2">Riwayat Alur Proses</h3>

                @if($history && $history->isNotEmpty())
                    <div class="space-y-4 relative before:absolute before:inset-0 before:left-3.5 before:w-0.5 before:bg-gray-100">
                        @foreach($history as $item)
                            <div class="relative pl-8 space-y-1">
                                <div class="absolute left-0 top-1 w-7 h-7 rounded-full bg-[#061D38] text-white flex items-center justify-center text-[10px] font-bold">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="bg-gray-50/70 p-3.5 border border-gray-100 rounded-xl space-y-1">
                                    <span class="block text-[10px] font-extrabold text-gray-400 uppercase">{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</span>
                                    <span class="block text-xs font-extrabold text-[#061D38]">{{ $item->statusDokumen?->status ?? '-' }}</span>
                                    @if($item->catatan_dokumen)
                                        <p class="text-[11px] font-semibold text-amber-800 bg-amber-50 p-2.5 rounded-lg border border-amber-100 mt-1.5">
                                            Catatan: {{ $item->catatan_dokumen }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs font-medium text-gray-400 italic">Belum ada alur riwayat.</p>
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
