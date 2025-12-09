<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1f1f1f] text-gray-100">
        <div class="py-10">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <a href="{{ route('transactions.index') }}" class="text-[#facc15] hover:underline font-bold mb-6 inline-block">← Kembali</a>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#dc2626] rounded-2xl shadow-2xl overflow-hidden mb-8">
                    <div class="p-8 bg-gradient-to-r from-[#dc2626] to-black">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-5xl font-black text-[#facc15]">{{ $transaction->transaction_number }}</h2>
                                <p class="text-lg mt-2">Dibuat {{ $transaction->created_at->format('d F Y, H:i') }} oleh {{ $transaction->creator->name }}</p>
                            </div>
                            <span class="px-6 py-3 text-xl font-bold rounded-lg {{ $transaction->status=='pending' ? 'bg-[#facc15] text-black' : 'bg-green-600 text-white' }}">
                                {{ $transaction->status=='pending' ? 'PENDING' : 'DISETUJUI' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="backdrop-blur-lg bg-[#1f2937]/80 border border-[#374151] rounded-2xl p-6">
                            <h3 class="text-2xl font-black text-[#facc15] mb-4 border-b border-[#dc2626] pb-3">Item Transaksi ({{ $transaction->products->count() }})</h3>
                            <table class="w-full">
                                <thead class="text-[#facc15] text-xs uppercase border-b border-[#dc2626]">
                                    <tr><th class="py-3 text-left">Sparepart</th><th class="py-3 text-left">Kategori</th><th class="py-3 text-right">Jumlah</th></tr>
                                </thead>
                                <tbody class="divide-y divide-[#374151]">
                                    @foreach($transaction->products as $product)
                                        <tr>
                                            <td class="py-4 flex items-center gap-4">
                                                @if($product->image_path)<img src="{{ Storage::url($product->image_path) }}" class="w-12 h-12 rounded-lg object-cover">@endif
                                                <div>
                                                    <p class="font-bold">{{ $product->name }}</p>
                                                    <p class="text-sm text-gray-400 font-mono">{{ $product->sku }}</p>
                                                </div>
                                            </td>
                                            <td class="py-4 text-gray-300">{{ $product->category->name ?? '-' }}</td>
                                            <td class="py-4 text-right font-black text-2xl text-[#facc15]">{{ $product->pivot->quantity }} {{ $product->unit }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($transaction->notes)
                            <div class="bg-yellow-600/20 border border-[#facc15] rounded-xl p-6">
                                <p class="text-[#facc15] font-bold mb-2">Catatan:</p>
                                <p class="italic">"{{ $transaction->notes }}"</p>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-6">
                        <div class="backdrop-blur-lg bg-[#1f2937]/80 border border-[#374151] rounded-2xl p-6">
                            <h4 class="text-xl font-black text-[#facc15] border-b border-[#dc2626] pb-3 mb-4">Detail</h4>
                            <div class="space-y-4 text-sm">
                                <div><span class="text-gray-400">Tipe:</span> <p class="font-bold {{ $transaction->type=='incoming'?'text-green-400':'text-orange-400' }}">{{ $transaction->type=='incoming'?'MASUK':'KELUAR' }}</p></div>
                                <div><span class="text-gray-400">Tanggal:</span> <p class="font-bold">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d F Y') }}</p></div>
                                @if($transaction->type=='incoming')
                                    <div><span class="text-gray-400">Supplier:</span> <p class="font-bold text-[#facc15]">{{ $transaction->supplier->name ?? '-' }}</p></div>
                                @else
                                    <div><span class="text-gray-400">Pelanggan:</span> <p class="font-bold text-[#facc15]">{{ $transaction->customer_name ?? '-' }}</p></div>
                                @endif
                            </div>
                        </div>

                        @if($transaction->status=='pending' && Auth::user()->role=='manager')
                            <div class="bg-gradient-to-r from-[#dc2626] to-[#facc15] p-8 rounded-2xl text-black text-center">
                                <form action="{{ route('transactions.approve', $transaction) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-4 bg-green-600 hover:bg-green-700 text-white font-black rounded-lg transition" onclick="return confirm('Setujui transaksi ini?')">
                                        APPROVE & UPDATE STOK
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>