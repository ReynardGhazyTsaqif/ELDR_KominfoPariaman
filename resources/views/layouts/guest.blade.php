<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ELDR - Elektronik Legal Dokumen Review') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#062144] selection:bg-[#1E3A66] selection:text-white">
        <div class="min-h-screen flex flex-col justify-center items-center py-10 px-4 sm:px-6">
            {{ $slot }}

            <footer class="mt-8 text-center text-xs text-[#8EA2C0] leading-relaxed">
                <p>&copy; {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Pariaman.</p>
                <p class="mt-0.5 text-[#6D84A8]">All rights reserved for official government use.</p>
            </footer>
        </div>
    </body>
</html>
