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
    <body class="font-sans antialiased bg-[#F8FAFC] text-gray-800 selection:bg-[#062447] selection:text-white">
        <div class="min-h-screen flex bg-[#F8FAFC]" x-data="{ sidebarOpen: false }">
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
                    <div class="px-6 py-6 flex items-center justify-between border-b border-[#123258] flex-shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="p-1.5 bg-white/10 rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-8 w-auto object-contain">
                            </div>
                            <div>
                                <h1 class="font-black text-xl tracking-tight text-white leading-none">ELDR</h1>
                                <span class="text-[10px] text-gray-300 font-bold tracking-wider block mt-0.5 uppercase">KOTA PARIAMAN</span>
                            </div>
                        </div>

                        <!-- Mobile Close Button -->
                        <button type="button" @click="sidebarOpen = false" class="text-gray-400 hover:text-white lg:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Scrollable Navigation Area -->
                    <div class="px-3.5 py-6 flex-1 overflow-y-auto overflow-x-hidden [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        <nav class="space-y-1.5 text-sm font-medium">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            <a href="{{ route('documents.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('documents.index') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Daftar Dokumen</span>
                            </a>

                            <a href="{{ route('documents.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('documents.create') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.create') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span>Penyusunan</span>
                            </a>

                            @if(Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum') || Auth::user()->hasRole('super_admin')))
                                <a href="{{ route('documents.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('documents.approvals') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('documents.approvals') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Persetujuan</span>
                                </a>
                            @endif

                            <a href="{{ route('documents.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('documents.history') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.history') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Riwayat</span>
                            </a>

                            <a href="{{ route('pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('pegawai.index') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('pegawai.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Pengaturan</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar Bottom Actions: Logout & Yellow "+ BUAT DOKUMEN BARU" button -->
                <div class="p-4 border-t border-[#123258] bg-[#061D38] flex-shrink-0 space-y-3">
                    @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('super_admin')))
                        <a href="{{ route('documents.create') }}" class="w-full bg-[#FFC72C] hover:bg-[#E5B224] text-[#061D38] font-black py-2.5 px-4 rounded-xl shadow-md transition-all text-xs tracking-wider uppercase flex items-center justify-center gap-2 cursor-pointer">
                            <div class="w-4 h-4 rounded-full bg-[#061D38] text-[#FFC72C] flex items-center justify-center font-bold text-xs">+</div>
                            <span>BUAT DOKUMEN BARU</span>
                        </a>
                    @endif

                    <!-- Keluar (Logout) Link -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-gray-300 hover:text-rose-400 transition-all cursor-pointer rounded-lg hover:bg-white/5">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Right Workspace -->
            <div class="flex-1 min-w-0 flex flex-col min-h-screen lg:pl-64 transition-all duration-300">
                <!-- Top Navbar Header -->
                <header class="bg-white border-b border-gray-200/80 sticky top-0 z-20 px-6 py-3.5 flex items-center justify-between shadow-2xs">
                    <!-- Left Section: Hamburger Toggle & Breadcrumb -->
                    <div class="flex items-center gap-4">
                        <button type="button" @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:text-[#062447] rounded-xl focus:outline-none lg:hidden cursor-pointer hover:bg-gray-100 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="sidebarOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-2 text-xs text-gray-500 font-semibold">
                            <span>Dashboard</span>
                            <span class="text-gray-400">›</span>
                            <span class="font-extrabold text-[#062447]">Dokumen Saya</span>
                        </div>
                    </div>

                    <!-- Center Search Bar & Right Profile -->
                    <div class="flex items-center gap-6">
                        <!-- Search Box -->
                        <div class="relative hidden sm:block w-72">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Cari dokumen..." class="w-full pl-10 pr-4 py-2 bg-[#F1F5F9] border-0 rounded-xl text-xs text-gray-800 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-[#062447]/20 transition-all">
                        </div>

                        <!-- Notification Bell -->
                        <button type="button" class="relative p-2 text-gray-500 hover:text-[#062447] hover:bg-gray-100 rounded-xl transition-all cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
                        </button>

                        <!-- User Profile Badge Dropdown -->
                        @if(Auth::user())
                            <div class="relative border-l border-gray-200 pl-4" x-data="{ openProfile: false }">
                                <button type="button" @click="openProfile = !openProfile" class="flex items-center gap-3 focus:outline-none cursor-pointer group">
                                    <div class="text-right hidden sm:block">
                                        <span class="block text-xs font-black text-[#062447] leading-none group-hover:text-blue-600 transition-all">{{ Auth::user()->name }}</span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mt-1">
                                            {{ str_replace('_', ' ', Auth::user()->roles->first()?->name ?? 'OPD PARIAMAN') }}
                                        </span>
                                    </div>
                                    <div class="w-9 h-9 rounded-full bg-[#062447] text-white flex items-center justify-center font-black text-xs shadow-sm ring-2 ring-gray-100 group-hover:ring-[#062447] transition-all">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="openProfile"
                                     @click.away="openProfile = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     x-cloak
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <p class="text-xs font-bold text-[#062447] truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-all flex items-center gap-2 cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Keluar (Logout)</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </header>

                <!-- Page Main Body Container -->
                <main class="flex-1 p-6 lg:p-8 space-y-6">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200/80 px-8 py-4 text-xs font-semibold text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div>
                        &copy; 2023 <span class="font-bold text-[#062447]">Dinas Komunikasi dan Informatika Kota Pariaman</span>
                    </div>
                    <div class="flex items-center gap-4 text-gray-500 font-medium">
                        <a href="#" class="hover:text-[#062447] transition-all">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-[#062447] transition-all">Syarat &amp; Ketentuan</a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
