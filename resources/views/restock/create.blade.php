<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">BUAT PO RESTOCK</h2>
                        <p class="text-gray-400 mt-1">Pesan sparepart dari supplier resmi</p>
                    </div>
                    <a href="{{ route('restock.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-[#facc15] font-bold uppercase rounded-lg transition">
                        Batal
                    </a>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('restock.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Supplier</label>
                                <select name="supplier_id" class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id')==$supplier->id?'selected':'' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Tanggal Order</label>
                                <input type="date" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}" class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4" required>
                            </div>
                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Estimasi Tiba</label>
                                <input type="date" name="expected_delivery_date" value="{{ old('expected_delivery_date') }}" class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                            </div>
                        </div>

                        <div class="h-px bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] mb-8"></div>

                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-black uppercase text-[#facc15]">DAFTAR ITEM</h3>
                            <button type="button" onclick="addProductRow()" class="px-5 py-2.5 bg-[#dc2626] hover:bg-[#ef4444] text-white font-bold rounded-lg transition">+ Tambah Item</button>
                        </div>

                        <div class="bg-[#111111]/50 border-2 border-dashed border-[#374151] rounded-xl p-6 mb-6">
                            <table class="w-full">
                                <thead class="text-[#facc15] text-sm uppercase border-b-2 border-[#dc2626]">
                                    <tr><th class="py-3 text-left">Sparepart</th><th class="py-3 text-left">Jumlah</th><th class="py-3 text-right">Hapus</th></tr>
                                </thead>
                                <tbody id="product_rows" class="divide-y divide-[#374151]">
                                    <tr id="row_0">
                                        <td class="py-4">
                                            <select name="products[0][id]" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required>
                                                <option value="">-- Pilih Sparepart --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->sku }} - {{ $product->name }} ({{ $product->stock_current }})</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="py-4"><input type="number" name="products[0][quantity]" min="1" value="1" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required></td>
                                        <td class="py-4 text-right"><button type="button" onclick="removeRow(0)" class="text-[#dc2626] hover:text-[#facc15] font-bold">Hapus</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3" class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg p-4 placeholder-[#64748b]">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Kirim Purchase Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let rowCount = 1;
        function addProductRow() { /* ... sama seperti sebelumnya, hanya ukuran input lebih kecil ... */ }
        function removeRow(id) { /* ... sama ... */ }
    </script>
</x-app-layout>