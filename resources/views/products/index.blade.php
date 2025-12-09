<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h1 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Daftar Sparepart</h1>
                    <p class="text-gray-400 mt-2">Total: {{ $products->total() }} item</p>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl shadow-2xl overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#dc2626] to-[#facc15] relative">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative flex justify-between items-center">
                            <h3 class="text-2xl font-black uppercase text-black">INVENTARIS BENGKEL</h3>
                            <a href="{{ route('products.create') }}" class="px-6 py-3 bg-black text-[#facc15] font-bold uppercase rounded-lg shadow-lg hover:bg-[#facc15] hover:text-black transition">
                                + Tambah Sparepart
                            </a>
                        </div>
                    </div>

                    <div class="p-6 border-b border-[#374151]">
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama..." class="bg-[#111111] border border-[#374151] rounded-lg py-2 px-4">
                            <select name="category_id" onchange="this.form.submit()" class="bg-[#111111] border border-[#374151] rounded-lg py-2 px-4">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <select name="stock_status" onchange="this.form.submit()" class="bg-[#111111] border border-[#374151] rounded-lg py-2 px-4">
                                <option value="">Semua Stok</option>
                                <option value="low_stock" {{ request('stock_status')=='low_stock'?'selected':'' }}>Stok Rendah</option>
                                <option value="out_of_stock" {{ request('stock_status')=='out_of_stock'?'selected':'' }}>Habis</option>
                            </select>
                            <a href="{{ route('products.index') }}" class="bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg py-2 px-4 text-center">Reset</a>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#111111] text-[#facc15] text-xs uppercase font-bold">
                                <tr class="border-b-2 border-[#dc2626]">
                                    <th class="px-6 py-4 text-left">#</th>
                                    <th class="px-6 py-4 text-left">Gambar</th>
                                    <th class="px-6 py-4 text-left">Kode / Nama</th>
                                    <th class="px-6 py-4 text-left">Kategori</th>
                                    <th class="px-6 py-4 text-center">Harga</th>
                                    <th class="px-6 py-4 text-center">Stok</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#374151]">
                                @forelse($products as $p)
                                    <tr class="hover:bg-[#dc2626]/10 transition">
                                        <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            @if($p->image_path)
                                                <img src="{{ Storage::url($p->image_path) }}" class="w-14 h-14 rounded-lg object-cover border border-[#facc15]">
                                            @else
                                                <div class="w-14 h-14 bg-[#374151] rounded-lg"></div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-[#facc15]">{{ $p->sku }}</div>
                                            <div class="text-sm text-gray-300">{{ Str::limit($p->name, 30) }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $p->category->name }}</td>
                                        <td class="px-6 py-4 text-center font-bold text-green-400">Rp {{ number_format($p->sale_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @if($p->stock_current == 0)
                                                <span class="px-3 py-1 bg-red-600 text-white rounded-full text-xs font-bold">HABIS</span>
                                            @elseif($p->stock_current <= $p->stock_minimum)
                                                <span class="px-3 py-1 bg-yellow-600 text-black rounded-full text-xs font-bold animate-pulse">{{ $p->stock_current }}</span>
                                            @else
                                                <span class="text-[#facc15] font-bold">{{ $p->stock_current }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ route('products.show', $p) }}" class="inline-block p-2 bg-blue-600 hover:bg-blue-700 rounded-lg">Lihat</a>
                                            <a href="{{ route('products.edit', $p) }}" class="inline-block p-2 bg-[#facc15] hover:bg-white text-black rounded-lg">Edit</a>
                                            <form action="{{ route('products.destroy', $p) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Yakin hapus?')" class="p-2 bg-[#dc2626] hover:bg-red-700 rounded-lg">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center py-16 text-gray-500 text-xl">Belum ada sparepart</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-[#111111]/50 border-t border-[#374151]">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>