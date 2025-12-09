<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-8 py-10">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-6xl font-black uppercase tracking-tight text-[#facc15] drop-shadow-xl">
                            MOTORMAX WMS
                        </h2>
                        <p class="text-2xl font-bold mt-3">Halo, <span class="text-[#facc15]">{{ Auth::user()->name }}</span></p>
                        <p class="text-xl text-white/80">{{ strtoupper(Auth::user()->role) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-7xl font-black text-white">{{ now()->format('d') }}</p>
                        <p class="text-2xl font-bold text-[#facc15] -mt-2">{{ now()->translatedFormat('F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                @if(in_array(Auth::user()->role, ['admin', 'manager']))

                    <!-- Statistik -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl p-6 shadow-xl hover:scale-105 transition">
                            <p class="text-sm uppercase tracking-wider text-[#facc15] font-bold">Total Sparepart</p>
                            <p class="text-5xl font-black mt-3">{{ $data['total_products'] }}</p>
                        </div>
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-green-600 rounded-2xl p-6 shadow-xl hover:scale-105 transition">
                            <p class="text-sm uppercase tracking-wider text-green-400 font-bold">Nilai Stok</p>
                            <p class="text-3xl font-black text-green-400 mt-3">Rp {{ number_format($data['total_value'],0,',','.') }}</p>
                        </div>
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#facc15] rounded-2xl p-6 shadow-xl hover:scale-105 transition">
                            <p class="text-sm uppercase tracking-wider text-[#facc15] font-bold">Stok Kritis</p>
                            <p class="text-6xl font-black text-[#facc15] mt-3">{{ $data['low_stock_count'] }}</p>
                        </div>
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-blue-600 rounded-2xl p-6 shadow-xl hover:scale-105 transition">
                            <p class="text-sm uppercase tracking-wider text-blue-400 font-bold">Transaksi Bulan Ini</p>
                            <p class="text-5xl font-black text-blue-400 mt-3">{{ $data['transactions_month'] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Stok Kritis -->
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#dc2626] rounded-2xl shadow-xl">
                            <div class="p-5 bg-gradient-to-r from-[#dc2626] to-black text-white font-black text-xl uppercase">Stok Kritis</div>
                            <div class="p-6 max-h-80 overflow-y-auto">
                                @forelse($data['low_stock_items'] as $item)
                                    <div class="flex justify-between items-center py-4 border-b border-[#374151]">
                                        <div>
                                            <p class="font-bold text-lg text-[#facc15]">{{ $item->name }}</p>
                                            <p class="text-sm text-gray-400">Stok: {{ $item->stock_current }} | Min: {{ $item->stock_minimum }}</p>
                                        </div>
                                        <a href="{{ route('restock.create') }}" class="px-5 py-2 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold text-sm uppercase rounded-lg transition">
                                            Restock
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-10 text-lg">Semua stok aman!</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Aksi Cepat -->
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl p-8 shadow-xl">
                            <h3 class="text-2xl font-black uppercase text-[#facc15] mb-6">Aksi Cepat</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <a href="{{ route('products.create') }}" class="p-5 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold text-xl uppercase text-center rounded-xl transition hover:scale-105">
                                    + Tambah Sparepart
                                </a>
                                <a href="{{ route('transactions.create') }}" class="p-5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xl uppercase text-center rounded-xl transition hover:scale-105">
                                    + Transaksi Baru
                                </a>
                                @if(Auth::user()->role === 'manager')
                                    <a href="{{ route('restock.create') }}" class="p-5 bg-green-600 hover:bg-green-700 text-white font-bold text-xl uppercase text-center rounded-xl transition hover:scale-105">
                                        Buat PO Restock
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                @endif

                @if(Auth::user()->role === 'staff')
                    <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl p-16 text-center shadow-xl">
                        <h3 class="text-4xl font-black uppercase text-[#facc15] mb-4">Selamat Bekerja, {{ Auth::user()->name }}!</h3>
                        <p class="text-xl text-gray-300">Gunakan menu sidebar untuk kelola stok & transaksi harian</p>
                    </div>
                @endif

                @if(Auth::user()->role === 'supplier')
                    <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl p-16 text-center shadow-xl">
                        <h3 class="text-4xl font-black uppercase text-[#facc15] mb-4">Halo Supplier!</h3>
                        <p class="text-xl text-gray-300">Cek & konfirmasi PO di menu Restock</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>