@if(Auth::check())
<x-app-layout>
    <div class="min-h-[72vh] flex flex-col items-center justify-center text-center relative overflow-hidden py-12 px-4 space-y-6">
        <div class="w-20 h-20 bg-blue-50 border border-blue-100 rounded-3xl flex items-center justify-center shadow-xs">
            <svg class="w-10 h-10 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-black text-[#061D38] tracking-tight">Halaman Tidak Ditemukan (404)</h2>
            <p class="text-xs font-semibold text-gray-500 max-w-md mt-2 leading-relaxed">
                Halaman yang Anda cari tidak tersedia atau telah dipindahkan ke direktori lain dalam sistem ELDR Kota Pariaman.
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
    <title>404 - Halaman Tidak Ditemukan | ELDR Kota Pariaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F4F6F9] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 text-center space-y-6">
        <div class="flex justify-center">
            <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-12 w-auto">
        </div>
        <h1 class="text-5xl font-black text-[#061D38]">404</h1>
        <h2 class="text-lg font-black text-[#061D38]">Halaman Tidak Ditemukan</h2>
        <p class="text-xs font-semibold text-gray-500 leading-relaxed">
            Halaman yang Anda cari tidak tersedia dalam sistem ELDR Kota Pariaman.
        </p>
        <a href="{{ route('login') }}" class="inline-block w-full py-3 bg-[#062447] text-white font-extrabold text-xs rounded-xl shadow-md uppercase tracking-wider">
            Masuk ke Sistem (Login)
        </a>
    </div>
</body>
</html>
@endif
