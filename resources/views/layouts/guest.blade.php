<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-amber-950 antialiased bg-[#f7f3ee]">
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            <div class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-[#3f2a1f] via-[#4f3527] to-[#2f2017] text-[#f7efe6]">
                <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_20%_20%,#b08968_0%,transparent_45%),radial-gradient(circle_at_80%_80%,#7f5539_0%,transparent_40%)]"></div>
                <div class="relative z-10 flex flex-col justify-center px-16">
                    <p class="text-sm tracking-wide uppercase text-[#e6d5c4]">Library Management System</p>
                    <h1 class="mt-6 text-5xl font-bold leading-tight">LIBRARY HUB</h1>
                    <p class="mt-4 max-w-md text-base text-[#e9ddd1]">Secure access for administrators, staff, and student users.</p>
                </div>
            </div>

            <div class="flex items-center justify-center px-6 py-10 sm:px-10">
                <div class="w-full max-w-md rounded-2xl border border-[#e7ddd3] bg-white/95 p-7 shadow-[0_16px_40px_-24px_rgba(60,35,20,0.55)] sm:p-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
