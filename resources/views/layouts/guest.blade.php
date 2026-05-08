<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Helvetica Neue', 'Inter', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
        
        <style>
            body {
                font-family: 'Helvetica Neue', 'Inter', -apple-system, sans-serif;
                background-color: #f9fafb; /* gray-50 */
            }
        </style>
    </head>
    <body class="antialiased text-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
            <div class="mb-8">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-gray-900 rounded flex items-center justify-center text-white font-bold text-xs shadow-lg group-hover:rotate-6 transition-transform">
                        UK
                    </div>
                    <span class="text-xs font-bold tracking-[0.3em] uppercase text-gray-900">Uang Anak Kos</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white border border-gray-200 overflow-hidden rounded-lg">
                <div class="p-0">
                    <div class="px-8 py-6 bg-gray-900 text-white">
                        <h2 class="text-xs font-bold uppercase tracking-[0.3em] text-center">Akses Sistem Keuangan</h2>
                    </div>
                    <div class="px-8 py-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest tracking-[0.2em]">&copy; 2026 Rahmat Assidik. Professional Finance Tool.</p>
            </div>
        </div>
    </body>
</html>
