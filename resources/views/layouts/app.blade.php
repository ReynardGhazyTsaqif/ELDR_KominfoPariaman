<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ELDR Kota Pariaman') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/pariaman_logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Alpine.js & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-gray-800 selection:bg-[#062447] selection:text-white">
        <div class="min-h-screen flex bg-[#F8FAFC]" x-data="{ sidebarOpen: false, confirmLogout: false }">
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

                            <a href="{{ route('documents.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-none {{ request()->routeIs('documents.index') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Daftar Dokumen</span>
                            </a>

                            <a href="{{ route('documents.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-none {{ request()->routeIs('documents.create') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.create') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span>Penyusunan</span>
                            </a>

                            @if(Auth::user() && (Auth::user()->hasRole('admin_hukum') || Auth::user()->hasRole('kabag_hukum') || Auth::user()->hasRole('super_admin')))
                                <a href="{{ route('documents.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-none {{ request()->routeIs('documents.approvals') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('documents.approvals') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Persetujuan</span>
                                </a>
                            @endif

                            <a href="{{ route('documents.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-none {{ request()->routeIs('documents.history') ? 'bg-[#123258] text-white font-bold shadow-xs' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                <svg class="w-5 h-5 {{ request()->routeIs('documents.history') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Riwayat</span>
                            </a>


                            @if(Auth::user() && Auth::user()->hasRole('super_admin'))
                                <div class="pt-3 pb-1">
                                    <span class="px-3.5 text-[10px] font-extrabold uppercase tracking-wider text-gray-400">PENGATURAN SYSTEM</span>
                                </div>

                                <a href="{{ route('master.desa') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-none {{ request()->routeIs('master.desa') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.desa') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7c0-2-1.5-3-3.5-3h-9C5.5 4 4 5 4 7zm0 5h16" />
                                    </svg>
                                    <span>Data Desa (Master)</span>
                                </a>

                                <a href="{{ route('master.staf') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-none {{ request()->routeIs('master.staf') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.staf') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Staf Desa &amp; Masyarakat</span>
                                </a>

                                <a href="{{ route('master.jenis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-none {{ request()->routeIs('master.jenis') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.jenis') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V7.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 1H7a2 2 0 00-2 2v16a2 2 0 002 2z" />
                                    </svg>
                                    <span>Jenis Dokumen (Master)</span>
                                </a>

                                <a href="{{ route('master.status') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-none {{ request()->routeIs('master.status') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('master.status') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10m-8 5h8" />
                                    </svg>
                                    <span>Referensi Status</span>
                                </a>

                                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-none {{ request()->routeIs('users.index') ? 'bg-[#123258] text-white shadow-sm font-semibold' : 'text-gray-300 hover:bg-[#123258]/60 hover:text-white' }} transition-all">
                                    <svg class="w-5 h-5 {{ request()->routeIs('users.index') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Pengaturan User</span>
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>

                <!-- Sidebar Bottom Actions: Logout & Yellow "+ BUAT DOKUMEN BARU" button -->
                <div class="p-4 border-t border-[#123258] bg-[#061D38] flex-shrink-0 space-y-3">
                    @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('super_admin')))
                        <a href="{{ route('documents.create') }}" class="w-full bg-[#FFC72C] hover:bg-[#E5B224] text-[#061D38] font-black py-2.5 px-4 rounded-none shadow-md transition-all text-xs tracking-wider uppercase flex items-center justify-center gap-2 cursor-pointer">
                            <div class="w-4 h-4 rounded-none bg-[#061D38] text-[#FFC72C] flex items-center justify-center font-bold text-xs">+</div>
                            <span>BUAT DOKUMEN BARU</span>
                        </a>
                    @endif

                    <!-- Keluar (Logout) Link -->
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="button" @click="confirmLogout = true" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-gray-300 hover:text-rose-400 transition-all cursor-pointer rounded-none hover:bg-white/5">
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
                        <button type="button" @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:text-[#062447] rounded-none focus:outline-none lg:hidden cursor-pointer hover:bg-gray-100 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="sidebarOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        
                    </div>

                    <!-- Center Search Bar & Right Profile -->
                    <div class="flex items-center gap-6">
                        

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
                                    <div class="w-9 h-9 rounded-none bg-[#062447] text-white flex items-center justify-center font-black text-xs shadow-sm ring-2 ring-gray-100 group-hover:ring-[#062447] transition-all">
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
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-none shadow-xl border border-gray-100 py-1 z-50">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <p class="text-xs font-bold text-[#062447] truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    <button type="button" @click="confirmLogout = true; openProfile = false" class="w-full text-left px-4 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-all flex items-center gap-2 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Keluar (Logout)</span>
                                    </button>
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

            <!-- Logout Confirmation Modal Alert (Centered & Formal Square) -->
            <div x-show="confirmLogout"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-cloak
                 class="fixed inset-0 z-50 flex items-center justify-center p-4">
                
                <!-- Modal Backdrop Overlay -->
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" @click="confirmLogout = false"></div>

                <!-- Centered Alert Modal Card (Square Formal Design) -->
                <div class="relative bg-white dark:bg-gray-800 border-2 border-[#061D38] dark:border-gray-600 shadow-2xl p-6 w-full max-w-md z-10 text-center rounded-none transform transition-all">
                    <!-- Warning Icon -->
                    <div class="mx-auto flex items-center justify-center h-14 w-14 bg-rose-100 border border-rose-300 text-rose-600 mb-4 rounded-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-extrabold text-gray-900 dark:text-white tracking-tight uppercase">
                        Konfirmasi Logout
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Apakah Anda yakin ingin keluar dari akun <span class="font-extrabold text-[#061D38] dark:text-blue-400">ELDR Kota Pariaman</span>?
                    </p>

                    <!-- Modal Action Buttons -->
                    <div class="mt-6 flex items-center justify-center gap-3">
                        <button type="button" 
                                @click="confirmLogout = false" 
                                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs uppercase tracking-wider border border-gray-300 transition-all rounded-none cursor-pointer">
                            Batal
                        </button>
                        <button type="button" 
                                @click="document.getElementById('logout-form').submit()" 
                                class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider shadow-md transition-all rounded-none cursor-pointer">
                            Ya, Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
