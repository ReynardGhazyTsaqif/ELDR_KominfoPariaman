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
        <div class="min-h-screen flex bg-[#F4F6F9]" x-data="{ sidebarOpen: false }">
            <!-- Mobile Backdrop Overlay -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false"
                 x-cloak
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden">
            </div>

            <!-- Sidebar Drawer (Responsive for Mobile & Desktop) -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                   class="w-64 bg-[#061D38] text-white flex flex-col justify-between flex-shrink-0 transition-transform duration-300 z-50 fixed top-0 bottom-0 left-0 h-screen overflow-hidden">
                <div class="flex-1 flex flex-col min-h-0">
                    <!-- Sidebar Header / Logo -->
                    <div class="px-6 py-5 flex items-center justify-between border-b border-[#133256] flex-shrink-0">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-9 w-auto object-contain">
                            <div>
                                <h1 class="font-extrabold text-lg tracking-tight text-white leading-none">ELDR</h1>
                                <span class="text-[10px] text-gray-300 font-semibold tracking-wider block mt-0.5 uppercase">KOTA PARIAMAN</span>
                            </div>
                        </div>

                        <!-- Mobile Close Button -->
                        <button type="button" @click="sidebarOpen = false" class="text-gray-400 hover:text-white lg:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Scrollable Navigation Area (Hidden Scrollbar, Smooth Scroll) -->
                    <div class="px-4 py-5 flex-1 overflow-y-auto overflow-x-hidden [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        <!-- Navigation Menu -->
                        <nav class="space-y-1 text-sm font-medium">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('pegawai.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('pegawai.index') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('pegawai.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5 5 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Direktori Pegawai</span>
                            </a>

                            <a href="{{ route('documents.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('documents.index') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Daftar Dokumen</span>
                            </a>

                            @if(Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum') || Auth::user()->hasRole('super_admin')))
                                <a href="{{ route('documents.approvals') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('documents.approvals') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('documents.approvals') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Persetujuan</span>
                                </a>
                            @endif

                            @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum')))
                                <a href="{{ route('documents.history') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('documents.history') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('documents.history') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Riwayat</span>
                                </a>
                            @endif

                            @if(Auth::user() && Auth::user()->hasRole('super_admin'))
                                <div class="pt-3 pb-1">
                                    <span class="px-3.5 text-[10px] font-extrabold uppercase tracking-wider text-gray-400">PENGATURAN SYSTEM</span>
                                </div>

                                <a href="{{ route('master.desa') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('master.desa') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.desa') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7c0-2-1.5-3-3.5-3h-9C5.5 4 4 5 4 7zm0 5h16" />
                                    </svg>
                                    <span>Data Desa (Master)</span>
                                </a>

                                <a href="{{ route('master.staf') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('master.staf') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.staf') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Staf Desa &amp; Masyarakat</span>
                                </a>

                                <a href="{{ route('master.jenis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('master.jenis') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.jenis') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 1H7a2 2 0 00-2 2v16a2 2 0 002 2z" />
                                    </svg>
                                    <span>Jenis Dokumen (Master)</span>
                                </a>

                                <a href="{{ route('master.status') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('master.status') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.status') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10m-8 5h8" />
                                    </svg>
                                    <span>Referensi Status</span>
                                </a>

                                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('users.index') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('users.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Pengaturan User</span>
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>

                <!-- Sidebar Bottom Actions -->
                <div class="p-4 border-t border-[#133256] space-y-2 bg-[#061D38] flex-shrink-0">
                    <a href="{{ route('documents.create') }}" class="w-full bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#061D38] font-black py-2.5 px-4 rounded-xl shadow-sm transition-all text-xs tracking-wider uppercase flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Buat Dokumen</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-2 text-xs font-bold uppercase text-rose-400 hover:text-rose-300 transition-all tracking-wider cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Right Workspace -->
            <div class="flex-1 min-w-0 flex flex-col min-h-screen lg:pl-64 transition-all duration-300">
                <!-- Top Navbar -->
                <header class="bg-white border-b border-gray-200 sticky top-0 z-20 px-4 sm:px-8 py-3.5 flex items-center justify-between shadow-xs">
                    <!-- Left Section: Hamburger Toggle & Breadcrumb -->
                    <div class="flex items-center gap-3">
                        <button type="button" @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:text-[#061D38] rounded-xl focus:outline-none lg:hidden cursor-pointer hover:bg-gray-100 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="sidebarOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 font-medium">
                            <span class="font-bold text-gray-900">ELDR</span>
                            <span class="text-gray-300">›</span>
                            <span class="truncate">
                                @if(request()->routeIs('dashboard'))
                                    Dashboard
                                @elseif(request()->routeIs('documents.*'))
                                    Manajemen Dokumen
                                @elseif(request()->routeIs('master.*'))
                                    Data Master System
                                @elseif(request()->routeIs('users.*'))
                                    Manajemen Pengguna
                                @elseif(request()->routeIs('pegawai.*'))
                                    Direktori Pegawai
                                @else
                                    Sistem ELDR
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Right Controls -->
                    <div class="flex items-center gap-3 sm:gap-6">
                        <!-- User Profile Info -->
                        @if(Auth::user())
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#062447] text-white flex items-center justify-center font-black text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <span class="block text-xs font-extrabold text-[#061D38] leading-none">{{ Auth::user()->name }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mt-0.5">
                                        {{ str_replace('_', ' ', Auth::user()->roles->first()?->name ?? 'User') }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </header>

                <!-- Page Main Body Container -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200/80 px-4 sm:px-8 py-4 text-center text-xs font-semibold text-gray-400 flex flex-col sm:flex-row items-center justify-between gap-2">
                    <div>
                        &copy; {{ date('Y') }} <span class="font-extrabold text-[#061D38]">ELDR Kota Pariaman</span>. Dinas Komunikasi dan Informatika.
                    </div>
                    <div class="text-[11px] font-mono text-gray-400">
                        Electronic Legal Document Repository v2.0
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
