<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Edit Sparepart</h2>
                    <p class="text-gray-400 mt-2">{{ $product->name }} ({{ $product->sku }})</p>
                    <div class="w-32 h-1 bg-gradient-to-r from-[#dc2626] to-[#facc15] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="grid lg:grid-cols-2 gap-8">

                            <!-- Kiri: Identitas -->
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-xl font-black uppercase text-[#facc15] border-b border-[#dc2626] pb-2">Identitas Barang</h4>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Kode SKU (Tidak Bisa Diubah)</label>
                                    <input type="text" value="{{ $product->sku }}" readonly class="w-full bg-[#111111]/70 border border-[#374151] rounded-lg py-3 px-4 text-gray-500">
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Nama Sparepart</label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                    @error('name') <p class="text-[#dc2626] text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Kategori</label>
                                    <select name="category_id" required class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Satuan</label>
                                    <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" required
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                </div>
                            </div>

                            <!-- Kanan: Stok & Harga -->
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-xl font-black uppercase text-[#facc15] border-b border-[#dc2626] pb-2">Stok & Harga</h4>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Harga Beli</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-3 text-gray-400">Rp</span>
                                            <input type="number" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" required
                                                class="pl-12 w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Harga Jual</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-3 text-gray-400">Rp</span>
                                            <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" required
                                                class="pl-12 w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Stok Saat Ini</label>
                                        <input type="number" name="stock_current" value="{{ old('stock_current', $product->stock_current) }}" required min="0"
                                            class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 text-center font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Batas Peringatan</label>
                                        <input type="number" name="stock_minimum" value="{{ old('stock_minimum', $product->stock_minimum) }}" required
                                            class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 text-center font-bold">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Lokasi Rak</label>
                                    <input type="text" name="storage_location" value="{{ old('storage_location', $product->storage_location) }}" placeholder="Rak B-03"
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                </div>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-2 gap-8 mt-8">
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Deskripsi Teknis</label>
                                <textarea name="description" rows="5" placeholder="Spesifikasi, kompatibilitas, dll..."
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Gambar Saat Ini</label>
                                    @if($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" class="w-48 h-48 rounded-xl object-cover border-4 border-[#facc15] shadow-lg">
                                        <label class="flex items-center mt-3 text-sm text-red-400 cursor-pointer">
                                            <input type="checkbox" name="delete_current_image" value="1" class="mr-2">
                                            Hapus gambar ini
                                        </label>
                                    @else
                                        <div class="w-48 h-48 bg-[#374151] rounded-xl flex items-center justify-center text-gray-500 font-bold">NO IMAGE</div>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Ganti Gambar (Opsional)</label>
                                    <input type="file" name="image_path" accept="image/*"
                                        class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#dc2626] file:text-white hover:file:bg-[#ef4444]">
                                    @error('image_path') <p class="text-[#dc2626] text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-[#374151]">
                            <a href="{{ route('products.show', $product) }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Update Sparepart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>