<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ELDR Kota Pariaman') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Alpine.js & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F4F6F9] text-gray-800 selection:bg-[#061D38] selection:text-white">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: true }">
            <!-- Sidebar -->
            <aside class="w-64 bg-[#061D38] text-white flex flex-col justify-between flex-shrink-0 transition-all duration-300 z-30 min-h-screen fixed top-0 bottom-0 left-0">
                <div>
                    <!-- Sidebar Header / Logo -->
                    <div class="px-6 py-5 flex items-center gap-3 border-b border-[#133256]">
                        <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-9 w-auto object-contain">
                        <div>
                            <h1 class="font-extrabold text-lg tracking-tight text-white leading-none">ELDR</h1>
                            <span class="text-[10px] text-gray-300 font-semibold tracking-wider block mt-0.5 uppercase">KOTA PARIAMAN</span>
                        </div>
                    </div>

                    <div class="px-4 py-5">
                        <!-- Navigation Menu -->
                        <nav class="space-y-1 text-sm font-medium">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#123258] text-white shadow-sm font-semibold transition-all">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('documents.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('documents.index') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Daftar Dokumen</span>
                            </a>

                            @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum')))
                                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Penyusunan</span>
                                </a>

                                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Riwayat</span>
                                </a>
                            @else
                                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7c0-2-1.5-3-3.5-3h-9C5.5 4 4 5 4 7zm0 5h16" />
                                    </svg>
                                    <span>Data Master</span>
                                </a>

                                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Pengaturan User</span>
                                </a>

                                <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span>Laporan</span>
                                </a>
                            @endif

                            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-[#123258]/60 hover:text-white transition-all">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Pengaturan</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar Bottom CTA Button -->
                <div class="p-4 border-t border-[#133256] space-y-2">
                    <a href="{{ route('documents.create') }}" class="w-full bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#061D38] font-black py-2.5 px-4 rounded-xl shadow-sm transition-all text-xs tracking-wider uppercase flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Buat Dokumen Baru</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-1.5 text-xs font-semibold uppercase text-rose-400 hover:text-rose-300 transition-all tracking-wider cursor-pointer mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Right Workspace -->
            <div class="flex-1 pl-64 flex flex-col min-h-screen">
                <!-- Top Navbar -->
                <header class="bg-white border-b border-gray-200 sticky top-0 z-20 px-8 py-3.5 flex items-center justify-between shadow-xs">
                    <!-- Left Breadcrumbs -->
                    <div class="flex items-center gap-3">
                        <button type="button" class="text-gray-500 hover:text-gray-700 cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                            <span class="font-bold text-gray-900">Dashboard</span>
                            <span class="text-gray-300">›</span>
                            <span>
                                @if(Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum')))
                                    Antrian Review
                                @elseif(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa')))
                                    Dokumen Saya
                                @else
                                    Ringkasan Sistem
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Right Controls -->
                    <div class="flex items-center gap-6">
                        <!-- Search Bar -->
                        <div class="relative w-72">
                            <input type="text" placeholder="Cari dokumen..." class="w-full bg-[#F0F4F8] text-sm text-gray-700 placeholder-gray-400 rounded-xl pl-10 pr-4 py-2 border-0 focus:outline-none focus:ring-2 focus:ring-[#061D38]/20">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Notification Bell -->
                        <button type="button" class="relative text-gray-500 hover:text-gray-700 cursor-pointer p-1.5 rounded-lg hover:bg-gray-100 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white font-extrabold text-[10px] rounded-full flex items-center justify-center border border-white">5</span>
                        </button>

                        <div class="h-6 w-px bg-gray-200"></div>

                        <!-- User Profile Widget & Interactive Dropdown -->
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" type="button" class="flex items-center gap-3 cursor-pointer focus:outline-none select-none">
                                <div class="text-right">
                                    <h4 class="text-xs font-bold text-gray-900 leading-none">{{ Auth::user()->name ?? 'Admin Hukum' }}</h4>
                                    <span class="text-[9px] font-extrabold text-gray-500 uppercase tracking-wider block mt-1">
                                        @if(Auth::user() && Auth::user()->hasRole('admin_hukum'))
                                            ADMIN HUKUM
                                        @elseif(Auth::user() && Auth::user()->hasRole('kabag_hukum'))
                                            KABAG HUKUM
                                        @elseif(Auth::user() && Auth::user()->hasRole('admin_opd'))
                                            OPD PARIAMAN
                                        @elseif(Auth::user() && Auth::user()->hasRole('admin_desa'))
                                            DESA PARIAMAN
                                        @else
                                            ADMINISTRATOR
                                        @endif
                                    </span>
                                </div>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin Hukum') }}&background=0A2540&color=fff" alt="Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-gray-100">
                            </button>

                            <!-- Profile Dropdown Menu -->
                            <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-cloak
                                 class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 z-50 transition-all">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Signed In As</p>
                                    <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->username ?? Auth::user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50 flex items-center gap-2 cursor-pointer transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Keluar (Logout)</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-8">
                    {{ $slot }}
                </main>

                <!-- Dashboard Footer -->
                <footer class="px-8 py-4 bg-white border-t border-gray-200 flex items-center justify-between text-xs text-gray-500 font-medium">
                    <p>&copy; {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Pariaman</p>
                    <div class="flex items-center gap-6 text-gray-500">
                        <a href="#" class="hover:text-gray-800 transition-all">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-gray-800 transition-all">Syarat & Ketentuan</a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
