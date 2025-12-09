<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1f1f1f] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-4xl font-black uppercase text-[#facc15]">Edit Transaksi</h2>
                        <p class="text-gray-400">Kode: <span class="text-[#facc15] font-mono">{{ $transaction->transaction_number }}</span></p>
                    </div>
                    <a href="{{ route('transactions.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-[#facc15] font-bold rounded-lg">Batal</a>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                        @csrf @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-[#111111]/50 rounded-xl">
                            <div><label class="text-[#facc15] font-bold">Tipe</label><p class="mt-2 p-3 bg-[#0f0f0f] rounded-lg">{{ $transaction->type=='incoming'?'BARANG MASUK':'BARANG KELUAR' }}</p></div>
                            <div><label class="text-[#facc15] font-bold">Tanggal</label><input type="date" value="{{ $transaction->transaction_date }}" class="mt-2 w-full bg-[#0f0f0f] border border-[#374151] rounded-lg py-3 px-4" readonly></div>
                        </div>

                        <div class="h-px bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] mb-8"></div>

                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-xl font-black text-[#facc15]">Edit Item</h3>
                            <button type="button" onclick="addProductRow()" class="px-5 py-2.5 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold rounded-lg">+ Tambah</button>
                        </div>

                        <div class="bg-[#111111]/50 border-2 border-dashed border-[#374151] rounded-xl p-6 mb-6">
                            <table class="w-full">
                                <thead class="text-[#facc15] text-xs uppercase border-b border-[#dc2626]">
                                    <tr><th class="py-3 text-left">Sparepart</th><th class="py-3 text-left">Jumlah</th><th class="py-3 text-right">Hapus</th></tr>
                                </thead>
                                <tbody id="product_rows" class="divide-y divide-[#374151]">
                                    @foreach($transaction->products as $index => $item)
                                        <tr id="row_{{ $index }}">
                                            <td class="py-4">
                                                <select name="products[{{ $index }}][id]" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" {{ $item->id==$product->id?'selected':'' }}>
                                                            {{ $product->sku }} - {{ $product->name }} ({{ $product->stock_current }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="py-4">
                                                <input type="number" name="products[{{ $index }}][quantity]" value="{{ $item->pivot->quantity }}" min="1" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required>
                                            </td>
                                            <td class="py-4 text-right">
                                                <button type="button" onclick="removeRow({{ $index }})" class="text-[#dc2626] hover:text-[#facc15] font-bold text-xl">×</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Catatan</label>
                            <textarea name="notes" rows="3" class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg p-4">{{ old('notes', $transaction->notes) }}</textarea>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('transactions.show', $transaction) }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg">Batal</a>
                            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Update Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.productOptions = `@foreach($products as $product)<option value="{{ $product->id }}">{{ $product->sku }} - {{ $product->name }} ({{ $product->stock_current }})</option>@endforeach`;
        let rowIndex = {{ $transaction->products->count() }};
        function addProductRow() {
            const tbody = document.getElementById('product_rows');
            const newRow = `
                <tr id="row_${rowIndex}">
                    <td class="py-4">
                        <select name="products[${rowIndex}][id]" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required>
                            <option value="">-- Pilih --</option>${window.productOptions}
                        </select>
                    </td>
                    <td class="py-4"><input type="number" name="products[${rowIndex}][quantity]" min="1" value="1" class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-2 px-3" required></td>
                    <td class="py-4 text-right"><button type="button" onclick="removeRow(${rowIndex})" class="text-[#dc2626] hover:text-[#facc15] font-bold text-xl">×</button></td>
                </tr>`;
            tbody.insertAdjacentHTML('beforeend', newRow);
            rowIndex++;
        }
        function removeRow(id) { document.getElementById('row_'+id).remove(); }
    </script>
</x-app-layout>