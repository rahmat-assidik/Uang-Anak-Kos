<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uang Anak Kos - Kelola Keuanganmu dengan Bijak</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Aplikasi pencatat keuangan terbaik khusus untuk anak kos. Pantau pemasukan dan pengeluaran harianmu dengan mudah.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Helvetica Neue', 'Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'custom': '4px',
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer components {
            .btn-admin {
                @apply px-4 py-2 text-xs font-bold uppercase tracking-widest transition-colors duration-150 rounded border;
            }
            .card-admin {
                @apply bg-white border border-gray-200 rounded-lg p-6;
            }
            .label-admin {
                @apply text-[10px] font-bold text-gray-400 uppercase tracking-widest;
            }
            .heading-admin {
                @apply text-lg font-bold text-gray-900 uppercase tracking-tight;
            }
        }
    </style>

    <style>
        body {
            font-family: 'Helvetica Neue', 'Inter', -apple-system, sans-serif;
            background-color: #f9fafb; /* gray-50 */
        }
    </style>
</head>
<body class="antialiased text-gray-800">
    <!-- Navigation (Flat Admin Style) -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-900 rounded flex items-center justify-center text-white font-bold text-[10px]">
                        UK
                    </div>
                    <span class="text-xs font-bold tracking-widest uppercase text-gray-900">Uang Anak Kos</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#fitur" class="text-[10px] font-bold text-gray-400 hover:text-blue-600 uppercase tracking-widest transition">Fitur</a>
                    <a href="#cara-kerja" class="text-[10px] font-bold text-gray-400 hover:text-blue-600 uppercase tracking-widest transition">Cara Kerja</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-3 border-l border-gray-100 pl-6">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-admin bg-blue-600 border-blue-600 text-white hover:bg-blue-700">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-[10px] font-bold text-gray-500 hover:text-gray-900 uppercase tracking-widest transition">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-admin bg-gray-900 border-gray-900 text-white hover:bg-black">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section class="py-20 md:py-32 bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl">
                    <div class="label-admin text-blue-600 mb-4 bg-blue-50 px-2 py-1 inline-block">Management Tool v1.0</div>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-[1.1] mb-8 tracking-tight">
                        PENCATATAN KEUANGAN<br>KOS YANG TERSTRUKTUR.
                    </h1>
                    <p class="text-base text-gray-500 mb-10 font-medium leading-relaxed max-w-xl">
                        Monitor pemasukan dan pengeluaran dengan antarmuka yang bersih dan fungsional. Dirancang khusus untuk efisiensi pengelolaan uang saku mahasiswa.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('register') }}" class="btn-admin bg-blue-600 border-blue-600 text-white hover:bg-blue-700 text-center">Mulai Sekarang</a>
                        <a href="#fitur" class="btn-admin bg-white border-gray-200 text-gray-600 hover:bg-gray-50 text-center">Pelajari Sistem</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid (Mirrors Dashboard Cards) -->
        <section id="fitur" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Core Modules</h3>
                    <div class="h-1 w-10 bg-blue-600"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-gray-200 bg-white overflow-hidden rounded-lg">
                    <div class="p-8 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition">
                        <div class="label-admin mb-4 text-green-600">Incomes</div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4 uppercase tracking-tight">Catat Saldo</h4>
                        <p class="text-gray-500 text-xs leading-relaxed font-medium">Sistem pencatatan pemasukan terpadu untuk melacak kiriman dana dan pendapatan lainnya.</p>
                    </div>
                    <div class="p-8 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition">
                        <div class="label-admin mb-4 text-red-600">Expenses</div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4 uppercase tracking-tight">Lacak Jajan</h4>
                        <p class="text-gray-500 text-xs leading-relaxed font-medium">Monitoring pengeluaran harian dengan kategori yang dapat disesuaikan untuk analisis penghematan.</p>
                    </div>
                    <div class="p-8 hover:bg-gray-50 transition">
                        <div class="label-admin mb-4 text-blue-600">Analytics</div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4 uppercase tracking-tight">Laporan Realtime</h4>
                        <p class="text-gray-500 text-xs leading-relaxed font-medium">Dapatkan ringkasan saldo aktual dan persentase pengeluaran langsung melalui dashboard Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Workflow Section (Mirrors List/Table Style) -->
        <section id="cara-kerja" class="py-20 bg-white border-y border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Implementation Workflow</h3>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="card-admin border-l-4 border-l-blue-600">
                        <div class="label-admin mb-2">Step 01</div>
                        <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-widest">Registrasi Akun</h4>
                        <p class="text-gray-500 text-xs font-medium leading-relaxed">Daftarkan identitas Anda untuk mengamankan database keuangan pribadi Anda.</p>
                    </div>
                    <div class="card-admin border-l-4 border-l-gray-900">
                        <div class="label-admin mb-2">Step 02</div>
                        <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-widest">Input Transaksi</h4>
                        <p class="text-gray-500 text-xs font-medium leading-relaxed">Lakukan pencatatan rutin setiap terjadi transaksi masuk atau keluar.</p>
                    </div>
                    <div class="card-admin border-l-4 border-l-green-600">
                        <div class="label-admin mb-2">Step 03</div>
                        <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-widest">Evaluasi Saldo</h4>
                        <p class="text-gray-500 text-xs font-medium leading-relaxed">Tinjau dashboard secara berkala untuk memastikan budget Anda tetap terkendali.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final Call to Action -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-2xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight uppercase">Mulai Manajemen Sekarang</h2>
                <div class="flex flex-col sm:flex-row justify-center gap-2">
                    <a href="{{ route('register') }}" class="btn-admin bg-gray-900 border-gray-900 text-white hover:bg-black">Daftar Akun Gratis</a>
                    <a href="{{ route('login') }}" class="btn-admin bg-white border-gray-200 text-gray-600 hover:bg-gray-50">Login Sistem</a>
                </div>
                <p class="mt-6 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Designed for students • Flat UI Architecture</p>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-200 py-10 text-center">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="w-6 h-6 bg-gray-900 rounded flex items-center justify-center text-white font-bold text-[8px]">UK</div>
                <span class="text-[10px] font-bold tracking-[0.3em] uppercase text-gray-900">Uang Anak Kos</span>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">&copy; 2026 Rahmat Assidik. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
