<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1f1f1f] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <a href="{{ route('restock.index') }}" class="text-[#facc15] hover:underline font-bold mb-6 inline-block">← Kembali</a>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#dc2626] rounded-2xl shadow-2xl overflow-hidden mb-8">
                    <div class="p-8 bg-gradient-to-r from-[#dc2626] to-black">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-5xl font-black text-[#facc15]">{{ $restockOrder->po_number }}</h2>
                                <p class="text-xl mt-2">Order: {{ \Carbon\Carbon::parse($restockOrder->order_date)->format('d F Y') }}</p>
                            </div>
                            @switch($restockOrder->status)
                                @case('pending')    <span class="px-6 py-3 bg-[#facc15] text-black font-bold rounded-lg">MENUNGGU</span>@break
                                @case('confirmed')  <span class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg">KONFIRMASI</span>@break
                                @case('shipped')    <span class="px-6 py-3 bg-purple-600 text-white font-bold rounded-lg">DIKIRIM</span>@break
                                @case('received')   <span class="px-6 py-3 bg-green-600 text-white font-bold rounded-lg">DITERIMA</span>@break
                            @endswitch
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="backdrop-blur-lg bg-[#1f2937]/80 border border-[#374151] rounded-2xl p-6">
                            <h3 class="text-2xl font-black text-[#facc15] mb-4 border-b border-[#dc2626] pb-3">Daftar Item ({{ $restockOrder->products->count() }})</h3>
                            <table class="w-full">
                                <thead class="text-[#facc15] text-xs uppercase border-b border-[#dc2626]">
                                    <tr><th class="py-3 text-left">Sparepart</th><th class="py-3 text-left">Kode</th><th class="py-3 text-right">Jumlah</th></tr>
                                </thead>
                                <tbody class="divide-y divide-[#374151]">
                                    @foreach($restockOrder->products as $product)
                                        <tr>
                                            <td class="py-4 flex items-center gap-4">
                                                @if($product->image_path)<img src="{{ Storage::url($product->image_path) }}" class="w-12 h-12 rounded-lg object-cover">@endif
                                                <span class="font-bold">{{ $product->name }}</span>
                                            </td>
                                            <td class="py-4 text-[#facc15] font-mono">{{ $product->sku }}</td>
                                            <td class="py-4 text-right font-black text-xl text-[#facc15]">{{ $product->pivot->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($restockOrder->notes)
                            <div class="bg-yellow-600/20 border border-[#facc15] rounded-xl p-6">
                                <p class="text-[#facc15] font-bold mb-2">Catatan:</p>
                                <p class="italic">"{{ $restockOrder->notes }}"</p>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-6">
                        <div class="backdrop-blur-lg bg-[#1f2937]/80 border border-[#374151] rounded-2xl p-6">
                            <h4 class="text-xl font-black text-[#facc15] border-b border-[#dc2626] pb-3 mb-4">Info PO</h4>
                            <div class="space-y-4 text-sm">
                                <div><span class="text-gray-400">Supplier:</span> <p class="font-bold text-[#facc15]">{{ $restockOrder->supplier->name ?? '-' }}</p></div>
                                <div><span class="text-gray-400">Dibuat oleh:</span> <p class="font-bold">{{ $restockOrder->creator->name ?? '-' }}</p></div>
                                <div><span class="text-gray-400">Estimasi tiba:</span> <p class="font-bold text-[#dc2626]">{{ $restockOrder->expected_delivery_date ? \Carbon\Carbon::parse($restockOrder->expected_delivery_date)->format('d F Y') : '-' }}</p></div>
                            </div>
                        </div>
                        <!-- Aksi supplier/manager tetap sama, hanya ukuran tombol lebih kecil -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>