<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xs font-bold text-gray-900 uppercase tracking-[0.3em]">
                {{ __('Dashboard Keuangan') }}
            </h2>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-white border border-gray-200 px-3 py-1 rounded">
                {{ now()->format('d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Berhasil (Flat Admin Style) -->
            @if(session('success'))
                <div class="mb-8 p-4 bg-gray-900 text-white border-l-4 border-l-green-500 flex items-center justify-between transition-all" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[10px] font-bold uppercase tracking-widest">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-white hover:text-gray-400 font-bold text-lg leading-none">&times;</button>
                </div>
            @endif

            <!-- Top Summary Cards (Unified Style) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border border-gray-200 bg-white mb-10 overflow-hidden rounded-lg shadow-sm">
                <!-- Saldo -->
                <div class="p-8 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition-colors group">
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-blue-600 transition-colors">Total Saldo Aktual</div>
                    <div class="text-3xl font-black text-gray-900 leading-tight tracking-tighter">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                    <div class="mt-4 flex">
                        <span class="text-[9px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2 py-1 rounded">AKTUAL</span>
                    </div>
                </div>
                <!-- Masuk -->
                <div class="p-8 border-b md:border-b-0 md:border-r border-gray-100 hover:bg-gray-50 transition-colors group">
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-green-600 transition-colors">Masuk Bulan Ini</div>
                    <div class="text-3xl font-black text-green-600 leading-tight tracking-tighter">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</div>
                    <div class="mt-4 flex">
                        <span class="text-[9px] font-bold text-green-600 uppercase tracking-widest bg-green-50 px-2 py-1 rounded">PEMASUKAN</span>
                    </div>
                </div>
                <!-- Keluar -->
                <div class="p-8 hover:bg-gray-50 transition-colors group">
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 group-hover:text-red-600 transition-colors">Keluar Bulan Ini</div>
                    <div class="text-3xl font-black text-red-600 leading-tight tracking-tighter">Rp {{ number_format($monthlyExpense, 0, ',', '.') }}</div>
                    <div class="mt-4 flex">
                        <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest bg-red-50 px-2 py-1 rounded">PENGELUARAN</span>
                    </div>
                </div>
            </div>

            <!-- Main Analytics & Actions -->
            <div class="bg-white border border-gray-200 rounded-lg mb-10 overflow-hidden shadow-sm">
                <div class="px-8 py-6 border-b border-gray-100 bg-white flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h3 class="text-xs font-bold text-gray-900 uppercase tracking-[0.2em]">Ringkasan Grafik Keuangan</h3>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-income')" class="px-5 py-2.5 bg-green-600 border border-green-600 text-white text-[10px] font-bold uppercase tracking-widest hover:bg-green-700 transition rounded">
                            + Masuk
                        </button>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-expense')" class="px-5 py-2.5 bg-red-600 border border-red-600 text-white text-[10px] font-bold uppercase tracking-widest hover:bg-red-700 transition rounded">
                            + Keluar
                        </button>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'manage-categories')" class="px-5 py-2.5 bg-gray-900 border border-gray-900 text-white text-[10px] font-bold uppercase tracking-widest hover:bg-black transition rounded">
                            Kategori
                        </button>
                    </div>
                </div>
                <div class="p-8">
                    <div class="h-72">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Transaction Logs -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Pemasukan Table -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="h-1 w-6 bg-green-500"></div>
                        <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em]">Log Pemasukan Terbaru</h3>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-8 py-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest">Detail Transaksi</th>
                                    <th class="px-8 py-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($incomes as $income)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-bold text-gray-900 uppercase tracking-tight">{{ $income->source }}</span>
                                                <span class="text-sm font-black text-green-600">+ Rp {{ number_format($income->amount, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($income->date)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <form action="{{ route('incomes.destroy', $income) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-300 hover:text-red-600 transition p-2" onclick="return confirm('Hapus data ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="p-16 text-center text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em]">Belum ada riwayat masuk</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pengeluaran Table -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="h-1 w-6 bg-red-500"></div>
                        <h3 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em]">Log Pengeluaran Terbaru</h3>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-8 py-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest">Detail Transaksi</th>
                                    <th class="px-8 py-4 text-[9px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($expenses as $expense)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-bold text-gray-900 uppercase tracking-tight">{{ $expense->category->name ?? 'N/A' }}</span>
                                                <span class="text-sm font-black text-red-600">- Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-300 hover:text-red-600 transition p-2" onclick="return confirm('Hapus data ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="p-16 text-center text-gray-400 font-bold text-[10px] uppercase tracking-[0.2em]">Belum ada riwayat keluar</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL RESTORED (KEMBALI KE ASAL) -->
    <x-modal name="add-income" focusable>
        <div class="p-0">
            <div class="p-6 bg-green-600 text-white">
                <h2 class="text-xs font-bold uppercase tracking-widest">Tambah Pemasukan</h2>
            </div>
            <form method="post" action="{{ route('incomes.store') }}" class="p-6 bg-white">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-input-label for="source" value="Sumber" />
                        <x-text-input id="source" name="source" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="amount" value="Jumlah" />
                            <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="date" value="Tanggal" />
                            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
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
                <h2 class="text-xs font-bold uppercase tracking-widest">Tambah Pengeluaran</h2>
            </div>
            <form method="post" action="{{ route('expenses.store') }}" class="p-6 bg-white">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-red-600 transition-colors text-sm font-medium" required>
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="amount_e" value="Jumlah" />
                            <x-text-input id="amount_e" name="amount" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="date_e" value="Tanggal" />
                            <x-text-input id="date_e" name="date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
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
            <div class="p-6 bg-gray-900 text-white">
                <h2 class="text-xs font-bold uppercase tracking-widest">Manajemen Kategori</h2>
            </div>
            <div class="p-6 bg-white">
                <form method="post" action="{{ route('categories.store') }}" class="mb-6 flex gap-2">
                    @csrf
                    <x-text-input name="name" type="text" class="flex-1" placeholder="Kategori Baru" required />
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white font-bold text-xs uppercase tracking-widest rounded transition">Tambah</button>
                </form>
                <div class="max-h-48 overflow-y-auto border border-gray-100 rounded">
                    @foreach($categories as $category)
                        <div class="flex items-center justify-between p-3 border-b border-gray-50 last:border-b-0 hover:bg-gray-50 transition">
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-tight">{{ $category->name }}</span>
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
                        labels: ['ARUS KEUANGAN'],
                        datasets: [
                            { 
                                label: 'MASUK', 
                                data: [{{ $monthlyIncome }}], 
                                backgroundColor: '#16a34a',
                                borderRadius: 4,
                            },
                            { 
                                label: 'KELUAR', 
                                data: [{{ $monthlyExpense }}], 
                                backgroundColor: '#dc2626',
                                borderRadius: 4,
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
                                    font: { weight: 'bold', size: 10, family: 'Helvetica Neue' } 
                                } 
                            }
                        },
                        scales: {
                            y: { 
                                beginAtZero: true, 
                                grid: { color: '#f3f4f6' },
                                ticks: { font: { size: 10, weight: 'bold' } }
                            },
                            x: { 
                                grid: { display: false },
                                ticks: { font: { size: 10, weight: 'bold' } }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>