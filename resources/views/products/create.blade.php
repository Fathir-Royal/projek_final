<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Tambah Sparepart Baru</h2>
                    <p class="text-gray-400 mt-2">Masukkan data suku cadang ke sistem</p>
                    <div class="w-32 h-1 bg-gradient-to-r from-[#dc2626] to-[#facc15] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid lg:grid-cols-2 gap-8">

                            <!-- Kiri: Identitas -->
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-xl font-black uppercase text-[#facc15] border-b border-[#dc2626] pb-2">Identitas Barang</h4>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Kode SKU</label>
                                    <input type="text" name="sku" value="{{ old('sku') }}" required placeholder="SP-YMH-001"
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                    @error('sku') <p class="text-[#dc2626] text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Nama Sparepart</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Oli Yamalube Super Sport 1L"
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Kategori</label>
                                    <select name="category_id" required class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Satuan</label>
                                    <input type="text" name="unit" value="{{ old('unit') }}" required placeholder="Pcs / Botol / Set"
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
                                            <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" required placeholder="75000"
                                                class="pl-12 w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Harga Jual</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-3 text-gray-400">Rp</span>
                                            <input type="number" name="sale_price" value="{{ old('sale_price') }}" required placeholder="95000"
                                                class="pl-12 w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Stok Awal</label>
                                        <input type="number" name="stock_current" value="{{ old('stock_current', 0) }}" min="0" required
                                            class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 text-center font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Batas Peringatan</label>
                                        <input type="number" name="stock_minimum" value="{{ old('stock_minimum', 5) }}" required
                                            class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 text-center font-bold">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Lokasi Rak</label>
                                    <input type="text" name="storage_location" value="{{ old('storage_location') }}" placeholder="Rak B-03"
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                </div>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-2 gap-8 mt-8">
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Deskripsi Teknis</label>
                                <textarea name="description" rows="5" placeholder="Spesifikasi, kompatibilitas, dll..."
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">{{ old('description') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Foto Sparepart (Wajib)</label>
                                <input type="file" name="image_path" accept="image/*" required
                                    class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#dc2626] file:text-white hover:file:bg-[#ef4444]">
                                <p class="text-xs text-gray-500 mt-2">JPG/PNG • Maks 2MB</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-[#374151]">
                            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Simpan Sparepart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>