@if(Auth::check())
<x-app-layout>
    <div class="min-h-[72vh] flex flex-col items-center justify-center text-center relative overflow-hidden py-12 px-4 space-y-6">
        <div class="w-20 h-20 bg-amber-50 border border-amber-200 rounded-3xl flex items-center justify-center shadow-xs">
            <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-black text-[#061D38] tracking-tight">Akses Ditolak (403 Forbidden)</h2>
            <p class="text-xs font-semibold text-gray-500 max-w-md mt-2 leading-relaxed">
                Anda tidak memiliki hak akses yang cukup untuk membuka fitur ini. Halaman ini khusus diperuntukkan bagi peranan yang berwenang.
            </p>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>

            <button onclick="window.history.back()" type="button" class="px-6 py-3 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer">
                Halaman Sebelumnya
            </button>
        </div>
    </div>
</x-app-layout>
@else
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | ELDR Kota Pariaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F4F6F9] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 text-center space-y-6">
        <div class="flex justify-center">
            <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-12 w-auto">
        </div>
        <h1 class="text-5xl font-black text-amber-500">403</h1>
        <h2 class="text-lg font-black text-[#061D38]">Akses Ditolak</h2>
        <p class="text-xs font-semibold text-gray-500 leading-relaxed">
            Anda tidak memiliki izin untuk mengakses halaman ini dalam sistem ELDR.
        </p>
        <a href="{{ route('login') }}" class="inline-block w-full py-3 bg-[#062447] text-white font-extrabold text-xs rounded-xl shadow-md uppercase tracking-wider">
            Masuk ke Sistem (Login)
        </a>
    </div>
</body>
</html>
@endif
