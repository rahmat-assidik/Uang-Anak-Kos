<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Keuangan Kos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Berhasil (Flat) -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 flex items-center justify-between" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm font-bold">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-800 font-bold">&times;</button>
                </div>
            @endif

            <!-- Ringkasan Kartu (Flat) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-gray-200 bg-white mb-8 overflow-hidden rounded-lg">
                <!-- Saldo -->
                <div class="p-6 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition">
                    <div class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total Saldo</div>
                    <div class="text-2xl font-bold text-gray-900 leading-tight">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                    <div class="mt-4 text-[10px] text-blue-600 font-bold tracking-widest bg-blue-50 px-2 py-1 inline-block">AKTUAL</div>
                </div>
                <!-- Masuk -->
                <div class="p-6 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition">
                    <div class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Masuk Bulan Ini</div>
                    <div class="text-2xl font-bold text-green-600 leading-tight">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</div>
                    <div class="mt-4 text-[10px] text-green-600 font-bold tracking-widest bg-green-50 px-2 py-1 inline-block">PEMASUKAN</div>
                </div>
                <!-- Keluar -->
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Keluar Bulan Ini</div>
                    <div class="text-2xl font-bold text-red-600 leading-tight">Rp {{ number_format($monthlyExpense, 0, ',', '.') }}</div>
                    <div class="mt-4 text-[10px] text-red-600 font-bold tracking-widest bg-red-50 px-2 py-1 inline-block">PENGELUARAN</div>
                </div>
            </div>

            <!-- Konten Utama (Flat) -->
            <div class="bg-white border border-gray-200 rounded-lg mb-8">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-tight">Grafik Keuangan</h3>
                    </div>
                    <div class="flex gap-2">
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-income')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-xs font-bold uppercase tracking-widest transition rounded">
                            + Pemasukan
                        </button>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-expense')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-xs font-bold uppercase tracking-widest transition rounded">
                            + Pengeluaran
                        </button>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'manage-categories')" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 text-xs font-bold uppercase tracking-widest transition rounded border border-gray-200">
                            Kategori
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-64">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- List Transaksi (Flat) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Pemasukan -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Riwayat Pemasukan</h3>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Detail</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($incomes as $income)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex justify-between">
                                                <div class="text-sm font-bold text-gray-800">{{ $income->source }}</div>
                                                <div class="text-sm font-bold text-green-600">Rp {{ number_format($income->amount, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-bold mt-1 uppercase">{{ \Carbon\Carbon::parse($income->date)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('incomes.destroy', $income) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-300 hover:text-red-600 transition" onclick="return confirm('Hapus?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="p-12 text-center text-gray-400 font-bold text-xs uppercase">Belum ada data</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pengeluaran -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Riwayat Pengeluaran</h3>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Detail</th>
                                    <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($expenses as $expense)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex justify-between">
                                                <div class="text-sm font-bold text-gray-800">{{ $expense->category->name ?? 'N/A' }}</div>
                                                <div class="text-sm font-bold text-red-600">Rp {{ number_format($expense->amount, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-bold mt-1 uppercase">{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-300 hover:text-red-600 transition" onclick="return confirm('Hapus?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="p-12 text-center text-gray-400 font-bold text-xs uppercase">Belum ada data</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals (Flat) -->

    <x-modal name="add-income" focusable>
        <div class="p-0">
            <div class="p-6 bg-green-600 text-white">
                <h2 class="text-lg font-bold uppercase tracking-widest">Tambah Pemasukan</h2>
            </div>
            <form method="post" action="{{ route('incomes.store') }}" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-input-label for="source" value="Sumber" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                        <x-text-input id="source" name="source" type="text" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-green-600 transition-colors" required />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="amount" value="Jumlah" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-green-600 transition-colors" required />
                        </div>
                        <div>
                            <x-input-label for="date" value="Tanggal" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-green-600 transition-colors" value="{{ date('Y-m-d') }}" required />
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-2">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border border-gray-200 text-gray-600 font-bold text-xs uppercase tracking-widest rounded hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white font-bold text-xs uppercase tracking-widest rounded hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="add-expense" focusable>
        <div class="p-0">
            <div class="p-6 bg-red-600 text-white">
                <h2 class="text-lg font-bold uppercase tracking-widest">Tambah Pengeluaran</h2>
            </div>
            <form method="post" action="{{ route('expenses.store') }}" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-input-label for="category_id" value="Kategori" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-red-600 transition-colors text-sm" required>
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="amount_e" value="Jumlah" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="amount_e" name="amount" type="number" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-red-600 transition-colors" required />
                        </div>
                        <div>
                            <x-input-label for="date_e" value="Tanggal" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="date_e" name="date" type="date" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-red-600 transition-colors" value="{{ date('Y-m-d') }}" required />
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-2">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border border-gray-200 text-gray-600 font-bold text-xs uppercase tracking-widest rounded hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white font-bold text-xs uppercase tracking-widest rounded hover:bg-red-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </x-modal>

    <x-modal name="manage-categories" focusable>
        <div class="p-0">
            <div class="p-6 bg-gray-800 text-white">
                <h2 class="text-lg font-bold uppercase tracking-widest">Kategori</h2>
            </div>
            <div class="p-6">
                <form method="post" action="{{ route('categories.store') }}" class="mb-6 flex gap-2">
                    @csrf
                    <x-text-input name="name" type="text" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-gray-800 transition-colors" placeholder="Kategori Baru" required />
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white font-bold text-xs uppercase tracking-widest rounded transition">Tambah</button>
                </form>
                <div class="max-h-48 overflow-y-auto border border-gray-100 rounded">
                    @foreach($categories as $category)
                        <div class="flex items-center justify-between p-3 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition">
                            <span class="text-sm font-bold text-gray-700">{{ $category->name }}</span>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition p-1" onclick="return confirm('Hapus?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border border-gray-200 text-gray-600 font-bold text-xs uppercase tracking-widest rounded transition">Tutup</button>
                </div>
            </div>
        </div>
    </x-modal>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('financeChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Bulan Ini'],
                        datasets: [
                            { 
                                label: 'Pemasukan', 
                                data: [{{ $monthlyIncome }}], 
                                backgroundColor: '#16a34a',
                                borderSkipped: false
                            },
                            { 
                                label: 'Pengeluaran', 
                                data: [{{ $monthlyExpense }}], 
                                backgroundColor: '#dc2626',
                                borderSkipped: false
                            }
                        ]
                    },
                    options: { 
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                position: 'bottom', 
                                labels: { 
                                    usePointStyle: true,
                                    font: { weight: 'bold', size: 10 } 
                                } 
                            }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>