<x-app-layout>
    <div x-data="{
        showConfirm: false,
        submitRevisionForm() {
            const form = document.getElementById('revision-submit-form');
            if (form) {
                if (form.submitted) return;
                form.submitted = true;
                form.submit();
            }
        }
    }">
        <!-- Background Document Context -->
        <div class="relative min-h-[550px] p-6 bg-slate-200/60 rounded-2xl opacity-40 pointer-events-none select-none">
            <div class="flex items-center justify-between border-b border-gray-300 pb-4 mb-6">
                <h2 class="text-xl font-bold text-gray-700">{{ $dokumen->dokumen_judul ?? 'Dokumen #' . ($dokumenId ?? 1) }}</h2>
                <div class="w-8 h-8 rounded-full bg-slate-400"></div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 h-96 bg-white rounded-xl shadow-xs"></div>
                <div class="h-96 bg-white rounded-xl shadow-xs"></div>
            </div>
        </div>

        <!-- Kirim Permintaan Revisi Modal Overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
            <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100/80">
                <!-- Modal Header -->
                <div class="bg-[#062447] text-white px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h3 class="text-base font-extrabold text-white tracking-tight">Kirim Permintaan Revisi</h3>
                    </div>
                    <a href="{{ route('documents.show', ['id' => $dokumenId ?? 1]) }}" class="text-gray-300 hover:text-white transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>

                <!-- Sub-header Document Info Strip -->
                <div class="bg-[#F6F4EF] px-6 py-3 flex items-center justify-between text-xs border-b border-gray-200/60">
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-gray-500 uppercase tracking-wider">DOKUMEN:</span>
                        <span class="font-bold text-[#062447]">{{ $dokumen->dokumen_judul ?? 'Dokumen #' . ($dokumenId ?? 1) }}</span>
                    </div>
                    <span class="inline-flex items-center gap-1.5 bg-amber-100/80 text-amber-800 font-extrabold px-2.5 py-0.5 rounded-full text-[10px] tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                        Menunggu Review
                    </span>
                </div>

                <!-- Form Content -->
                <form id="revision-submit-form" action="{{ route('documents.submitRevision', ['dokumenId' => $dokumenId ?? 1]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <!-- Catatan Revisi -->
                    <div>
                        <label for="catatan_revisi" class="block text-xs font-extrabold text-[#062447] uppercase tracking-wider mb-2">
                            CATATAN REVISI <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="catatan_revisi" name="catatan_revisi" rows="4" required
                                  placeholder="Berikan detail poin-poin yang perlu diperbaiki oleh instansi pengunggah..."
                                  class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all resize-none"></textarea>
                        <p class="text-[11px] text-gray-400 font-medium italic mt-1.5">
                            Mohon sebutkan nomor pasal atau ayat jika revisi bersifat spesifik.
                        </p>
                    </div>

                    <!-- Upload File Pendukung (Opsional) -->
                    <div>
                        <label class="block text-xs font-extrabold text-[#062447] uppercase tracking-wider mb-2">
                            UPLOAD FILE PENDUKUNG / MARKUP CORETAN (.DOC / .DOCX)
                        </label>
                        <div id="rev-file-container" class="relative border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center cursor-pointer transition-all bg-slate-50/60 hover:bg-blue-50/30 hover:border-[#062447] group">
                            <input type="file" name="file_pendukung" id="file_pendukung" accept=".doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleRevFileSelected(this)">

                            <div id="rev-default-prompt" class="flex flex-col items-center justify-center gap-2">
                                <div class="w-11 h-11 rounded-full bg-blue-50 text-[#062447] flex items-center justify-center group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <h4 class="text-xs font-extrabold text-gray-800">
                                    Klik untuk unggah atau seret berkas coretan/markup ke sini
                                </h4>
                                <p class="text-[11px] text-gray-400 font-medium">
                                    Format Microsoft Word (.doc / .docx) • Maksimal 20 MB (Opsional)
                                </p>
                            </div>

                            <div id="rev-success-prompt" class="hidden flex flex-col items-center justify-center gap-1.5 py-1">
                                <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase">
                                    ✓ Berkas Lampiran Dipilih
                                </span>
                                <h4 id="rev-filename-display" class="text-xs font-extrabold text-[#062447] break-all max-w-md mt-1"></h4>
                                <p id="rev-filesize-display" class="text-[11px] text-emerald-700 font-bold"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                        <a href="{{ route('documents.show', ['id' => $dokumenId ?? 1]) }}" class="px-5 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                            <span>Batal</span>
                        </a>
                        <button type="button" @click="showConfirm = true" class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                            <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span>Kirim Permintaan Revisi</span>
                        </button>
                    </div>
                </form>
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
                    <h3 class="text-base font-extrabold text-[#061D38]">Konfirmasi Permintaan Revisi</h3>
                    <p class="text-xs font-semibold text-gray-500 leading-relaxed">
                        Apakah Anda yakin catatan revisi ini sudah sesuai dan ingin dikirimkan ke instansi pengaju?
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" @click="showConfirm = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="button" @click="submitRevisionForm()" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md transition-all cursor-pointer">
                        Ya, Kirim Revisi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function handleRevFileSelected(input) {
        const defaultPrompt = document.getElementById('rev-default-prompt');
        const successPrompt = document.getElementById('rev-success-prompt');
        const nameDisplay = document.getElementById('rev-filename-display');
        const sizeDisplay = document.getElementById('rev-filesize-display');
        const container = document.getElementById('rev-file-container');

        if (input.files && input.files.length > 0) {
            const file = input.files[0];
            nameDisplay.textContent = file.name;
            sizeDisplay.textContent = 'Ukuran Berkas: ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';

            defaultPrompt.classList.add('hidden');
            successPrompt.classList.remove('hidden');
            container.classList.remove('border-slate-300', 'bg-slate-50/60');
            container.classList.add('border-emerald-500', 'bg-emerald-50/60');
        } else {
            defaultPrompt.classList.remove('hidden');
            successPrompt.classList.add('hidden');
            container.classList.remove('border-emerald-500', 'bg-emerald-50/60');
            container.classList.add('border-slate-300', 'bg-slate-50/60');
        }
    }
    </script>
</x-app-layout>
