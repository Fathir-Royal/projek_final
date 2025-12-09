<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1f1f1f] text-gray-100">
        <div class="py-10">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h1 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Detail Sparepart</h1>
                    <p class="text-2xl text-gray-300 mt-2">{{ $product->name }}</p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl p-8">
                            <div class="grid md:grid-cols-2 gap-8 items-center">
                                <div>
                                    @if($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" class="w-full rounded-xl border-4 border-[#facc15] shadow-xl object-cover">
                                    @else
                                        <div class="aspect-square bg-[#374151] rounded-xl flex items-center justify-center text-gray-500 font-bold">NO IMAGE</div>
                                    @endif
                                </div>
                                <div class="space-y-6">
                                    <div>
                                        <h2 class="text-3xl font-black">{{ $product->name }}</h2>
                                        <p class="text-xl text-[#facc15] font-mono">{{ $product->sku }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="p-4 bg-green-600/20 border border-green-500 rounded-lg text-center">
                                            <p class="text-green-400 text-sm font-bold">Harga Jual</p>
                                            <p class="text-2xl font-black">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="p-4 bg-blue-600/20 border border-blue-500 rounded-lg text-center">
                                            <p class="text-blue-400 text-sm font-bold">Harga Beli</p>
                                            <p class="text-xl font-bold">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div><span class="text-[#facc15] font-bold">Kategori:</span> <span class="text-xl">{{ $product->category->name }}</span></div>
                                    <div><span class="text-[#facc15] font-bold">Lokasi:</span> <span>{{ $product->storage_location ?: '-' }}</span></div>
                                </div>
                            </div>
                            <div class="mt-8 p-6 bg-[#111111]/50 rounded-xl">
                                <h3 class="text-xl font-black text-[#facc15] mb-3">Deskripsi</h3>
                                <p class="text-gray-300 leading-relaxed">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 {{ $product->stock_current <= $product->stock_minimum ? 'border-red-600' : 'border-green-600' }} rounded-2xl p-8 text-center">
                            <h3 class="text-2xl font-black mb-4">Stok Saat Ini</h3>
                            <p class="text-6xl font-black {{ $product->stock_current <= $product->stock_minimum ? 'text-red-500' : 'text-green-500' }}">
                                {{ $product->stock_current }}
                            </p>
                            <p class="text-xl text-gray-400 mt-2">{{ $product->unit }}</p>
                            @if($product->stock_current <= $product->stock_minimum)
                                <p class="mt-4 text-red-400 font-bold text-lg">STOK KRITIS!</p>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <a href="{{ route('products.edit', $product) }}" class="block text-center py-4 bg-[#facc15] hover:bg-white text-black font-bold rounded-lg transition">
                                Edit Sparepart
                            </a>
                            @if(Auth::user()->role === 'manager' && $product->stock_current <= $product->stock_minimum)
                                <a href="{{ route('restock.create') }}" class="block text-center py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition">
                                    Buat PO Restock
                                </a>
                            @endif
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus permanen?')" class="w-full py-4 bg-[#dc2626] hover:bg-red-700 text-white font-bold rounded-lg transition">
                                    Hapus Sparepart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>