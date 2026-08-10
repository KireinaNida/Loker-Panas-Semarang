<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Info Loker Panas') }} - Portal Lowongan Kerja Semarang</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-orange-400 selection:text-white min-h-screen relative overflow-x-hidden flex flex-col justify-between">
        
        <!-- Dynamic Ambient Background Glows -->
        <div class="fixed top-[-10%] right-[-5%] w-[450px] h-[450px] bg-orange-400/5 rounded-full blur-[120px] pointer-events-none -z-10"></div>
        <div class="fixed bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <main class="flex-1 flex flex-col sm:justify-center items-center px-4 sm:px-6 py-8 sm:py-12">
            <!-- Brand Logo Header -->
            <div class="mb-6 text-center">
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-3 group transition-transform duration-200 hover:scale-[1.02]">
                    <div class="w-12 h-12 bg-gradient-to-tr from-orange-400 to-blue-500 rounded-xl flex items-center justify-center font-extrabold text-2xl text-white shadow-lg shadow-orange-400/20 group-hover:rotate-6 transition-transform duration-200">
                        I
                    </div>
                    <div class="text-left">
                        <span class="block font-display text-xl font-extrabold text-slate-900 tracking-tight leading-none">Info Loker Panas</span>
                        <span class="text-[10px] font-bold text-orange-400 uppercase tracking-widest block mt-0.5">Semarang</span>
                    </div>
                </a>
            </div>

            <!-- Main Auth Card (Glass Card) -->
            <div class="w-full sm:max-w-md bg-white/85 backdrop-blur-md px-6 sm:px-8 py-8 shadow-md border border-slate-900/5 rounded-3xl relative z-10 transition-all duration-300">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-4 text-center text-xs text-slate-400 font-semibold">
            &copy; {{ date('Y') }} Info Loker Panas Semarang
        </footer>
    </body>
</html>
