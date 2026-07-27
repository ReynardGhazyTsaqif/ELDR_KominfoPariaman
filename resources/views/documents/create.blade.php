<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6" x-data="{
        showConfirm: false,
        submitForm() {
            const form = document.getElementById('create-doc-form');
            if (form) {
                if (form.submitted) return;
                form.submitted = true;
                form.submit();
            }
        }
    }">
        <!-- Main Form Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100/80">
            <!-- Dark Navy Header Strip -->
            <div class="bg-[#062447] text-white px-8 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-lg font-extrabold tracking-tight text-white">Pengajuan Dokumen Hukum Baru</h2>
                </div>
            </div>

            <!-- Form Content Body -->
            <form id="create-doc-form" action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <!-- Display Errors if any -->
                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold p-4 rounded-xl space-y-1">
                        <p class="font-extrabold text-sm">Gagal Mengajukan Dokumen:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Row 1: JUDUL DOKUMEN & JENIS DOKUMEN -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul File -->
                    <div>
                        <label for="judul_file" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            JUDUL DOKUMEN <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="judul_file" name="judul_file" value="{{ old('judul_file', old('nama_file')) }}" required
                               placeholder="Masukkan judul dokumen resmi..."
                               class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <!-- Jenis Dokumen -->
                    <div>
                        <label for="jenis_dokumen_key" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            JENIS DOKUMEN <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            @php
                                $jenisDokumenList = \App\Models\JenisDokumen::all();
                            @endphp
                            <select id="jenis_dokumen_key" name="jenis_dokumen_key" required
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                                <option value="" disabled {{ old('jenis_dokumen_key', old('jenis_dokumen')) ? '' : 'selected' }}>Pilih jenis dokumen...</option>
                                @foreach($jenisDokumenList as $jd)
                                    <option value="{{ $jd->jenis_dokumen_key }}" {{ old('jenis_dokumen_key', old('jenis_dokumen')) == $jd->jenis_dokumen_key ? 'selected' : '' }}>
                                        {{ $jd->jenis_dokumen }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <!-- Section 1: Upload File Naskah (PDF/DOCX) -->
                <div>
                    <label class="block text-xs font-extrabold text-[#061D38] uppercase tracking-wider mb-2">
                        UNGGAH BERKAS NASKAH DOKUMEN <span class="text-rose-500">*</span>
                    </label>
                    
                    <div id="upload-box-container" class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center cursor-pointer transition-all bg-gray-50/50 hover:bg-blue-50/40 hover:border-[#062447] group">
                        <input type="file" name="file" id="file" accept=".pdf,.doc,.docx" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleFileSelected(this)">
                        
                        <div id="upload-default-prompt" class="flex flex-col items-center justify-center gap-2">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#062447] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-extrabold text-gray-800">
                                Klik untuk memilih berkas atau seret ke area ini
                            </h4>
                            <p class="text-xs text-gray-400 font-medium">
                                Format yang didukung: PDF, Microsoft Word (.doc, .docx) • Maksimal 20 MB
                            </p>
                        </div>

                        <div id="upload-success-prompt" class="hidden flex flex-col items-center justify-center gap-2 py-2">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase">
                                ✓ Berkas Berhasil Dipilih
                            </span>
                            <h4 id="display-filename" class="text-xs font-extrabold text-[#062447] break-all max-w-md mt-1"></h4>
                            <p id="display-filesize" class="text-[11px] text-emerald-700 font-bold"></p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Metadata Dokumen -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 border-t border-gray-100">
                    <!-- Judul Dokumen -->
                    <div class="md:col-span-2">
                        <label for="judul_file" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            JUDUL DOKUMEN PRODUK HUKUM <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="judul_file" name="judul_file" value="{{ old('judul_file') }}" required
                               placeholder="Contoh: Ranperwako Pembentukan Susunan Organisasi Tata Kerja..."
                               class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <!-- Jenis Dokumen -->
                    <div>
                        <label for="jenis_dokumen_key" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            KATEGORI / JENIS DOKUMEN <span class="text-rose-500">*</span>
                        </label>
                        @php
                            $jenisList = \App\Models\JenisDokumen::all();
                        @endphp
                        <select id="jenis_dokumen_key" name="jenis_dokumen_key" required
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all cursor-pointer">
                            <option value="" disabled {{ old('jenis_dokumen_key') ? '' : 'selected' }}>-- Pilih Jenis Dokumen --</option>
                            @foreach($jenisList as $j)
                                <option value="{{ $j->jenis_dokumen_key }}" {{ old('jenis_dokumen_key') == $j->jenis_dokumen_key ? 'selected' : '' }}>
                                    {{ $j->jenis_dokumen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subjek Pengaju -->
                    <div>
                        <label for="subjek_key" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            INSTANSI / SUBJEK PENGAJU <span class="text-rose-500">*</span>
                        </label>
                        @php
                            $subjekList = \App\Models\Subjek::all();
                            $defaultSubjekKey = auth()->user()->subjek_key ?? null;
                        @endphp
                        <select id="subjek_key" name="subjek_key" required
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all cursor-pointer">
                            @foreach($subjekList as $s)
                                <option value="{{ $s->subjek_key }}" {{ (old('subjek_key') ?? $defaultSubjekKey) == $s->subjek_key ? 'selected' : '' }}>
                                    {{ $s->nama_subjek }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Section 3: Catatan Pengajuan -->
                <div>
                    <label for="catatan" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                        CATATAN / PENGANTAR PENGAJUAN <span class="text-gray-400 font-normal lowercase">(opsional)</span>
                    </label>
                    <textarea id="catatan" name="catatan" rows="4"
                              placeholder="Tambahkan instruksi khusus atau catatan untuk verifikator..."
                              class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all resize-none">{{ old('catatan') }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl transition-all shadow-xs">
                        Kembali
                    </a>
                    <button type="button" @click="showConfirm = true" class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span>Simpan & Ajukan</span>
                    </button>
                </div>
            </form>
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
                    <h3 class="text-base font-extrabold text-[#061D38]">Konfirmasi Pengajuan Dokumen</h3>
                    <p class="text-xs font-semibold text-gray-500 leading-relaxed">
                        Apakah Anda yakin data dokumen dan berkas naskah yang dipilih sudah sesuai dan siap diajukan untuk verifikasi hukum?
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" @click="showConfirm = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="button" @click="submitForm()" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md transition-all cursor-pointer">
                        Ya, Kirim Pengajuan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fail-safe JavaScript File Selection Feedback -->
    <script>
    function handleFileSelected(input) {
        const container = document.getElementById('upload-box-container');
        const defaultPrompt = document.getElementById('upload-default-prompt');
        const successPrompt = document.getElementById('upload-success-prompt');
        const nameDisplay = document.getElementById('display-filename');
        const sizeDisplay = document.getElementById('display-filesize');

        if (input.files && input.files.length > 0) {
            const file = input.files[0];
            nameDisplay.textContent = file.name;
            sizeDisplay.textContent = 'Ukuran Berkas: ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';
            
            defaultPrompt.classList.add('hidden');
            successPrompt.classList.remove('hidden');
            
            container.classList.remove('border-gray-300', 'bg-gray-50/50');
            container.classList.add('border-emerald-500', 'bg-emerald-50/60');

            // Auto-fill Judul Dokumen if empty
            const judulInput = document.getElementById('judul_file');
            if (judulInput && !judulInput.value.trim()) {
                const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
                judulInput.value = nameWithoutExt;
            }
        } else {
            defaultPrompt.classList.remove('hidden');
            successPrompt.classList.add('hidden');
            container.classList.remove('border-emerald-500', 'bg-emerald-50/60');
            container.classList.add('border-gray-300', 'bg-gray-50/50');
        }
    }
    </script>
</x-app-layout>
