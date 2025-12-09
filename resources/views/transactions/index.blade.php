<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl shadow-2xl overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] relative">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative flex justify-between items-center">
                            <div>
                                <h3 class="text-3xl font-black uppercase text-white">Riwayat Transaksi Stok</h3>
                                <p class="text-white/80">Semua pergerakan sparepart</p>
                            </div>
                            @if(Auth::user()->role !== 'supplier')
                                <a href="{{ route('transactions.create') }}" class="px-6 py-3 bg-black text-[#facc15] font-bold uppercase rounded-lg shadow-lg hover:bg-[#facc15] hover:text-black transition">
                                    + Transaksi Baru
                                </a>
                            @endif
                        </div>
                        <div class="flex gap-3 mt-5 flex-wrap">
                            <a href="{{ route('transactions.index') }}" class="px-5 py-2 rounded-lg font-bold text-sm {{ !request('type') ? 'bg-white text-[#dc2626]' : 'bg-white/20 hover:bg-white/30' }}">Semua</a>
                            <a href="{{ route('transactions.index', ['type'=>'incoming']) }}" class="px-5 py-2 rounded-lg font-bold text-sm {{ request('type')=='incoming' ? 'bg-green-600' : 'bg-white/20 hover:bg-white/30' }}">Masuk</a>
                            <a href="{{ route('transactions.index', ['type'=>'outgoing']) }}" class="px-5 py-2 rounded-lg font-bold text-sm {{ request('type')=='outgoing' ? 'bg-orange-600' : 'bg-white/20 hover:bg-white/30' }}">Keluar</a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#111111] text-[#facc15] text-xs uppercase font-bold">
                                <tr class="border-b-2 border-[#dc2626]">
                                    <th class="px-6 py-4 text-left">Kode TRX</th>
                                    <th class="px-6 py-4 text-left">Tipe</th>
                                    <th class="px-6 py-4 text-left">Tanggal</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-left">Item</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#374151]">
                                @forelse($transactions as $trx)
                                    <tr class="hover:bg-[#dc2626]/10 transition">
                                        <td class="px-6 py-5">
                                            <div class="font-black text-[#facc15]">{{ $trx->transaction_number }}</div>
                                            <div class="text-xs text-gray-400">by {{ $trx->creator->name ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="px-4 py-1.5 text-xs font-bold rounded-full {{ $trx->type=='incoming' ? 'bg-green-600/30 border border-green-500 text-green-300' : 'bg-orange-600/30 border border-orange-500 text-orange-300' }}">
                                                {{ $trx->type=='incoming' ? 'MASUK' : 'KELUAR' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
                                        <td class="px-6 py-5">
                                            <span class="px-4 py-1.5 text-xs font-bold rounded-full {{ $trx->status=='pending' ? 'bg-yellow-600/30 border border-[#facc15] text-[#facc15]' : 'bg-green-600 text-black' }}">
                                                {{ $trx->status=='pending' ? 'PENDING' : 'DISETUJUI' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 font-black">{{ $trx->products_count }}</td>
                                        <td class="px-6 py-5 text-center">
                                            <a href="{{ route('transactions.show', $trx) }}" class="px-5 py-2 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold text-sm rounded-lg transition">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="py-16 text-center text-gray-500 text-xl">Belum ada transaksi</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-[#111111]/50 border-t border-[#374151]">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>