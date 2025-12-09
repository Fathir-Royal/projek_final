<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Header -->
                    <div class="p-6 bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] relative">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative flex justify-between items-center">
                            <div>
                                <h3 class="text-3xl font-black uppercase text-white">PURCHASE ORDER</h3>
                                <p class="text-white/80">Kelola restock sparepart</p>
                            </div>
                            @if(Auth::user()->role === 'manager')
                                <a href="{{ route('restock.create') }}" class="px-6 py-3 bg-black text-[#facc15] font-bold uppercase rounded-lg shadow-lg hover:bg-[#facc15] hover:text-black transition">
                                    + Buat PO Baru
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#111111] text-[#facc15] text-xs uppercase font-bold">
                                <tr class="border-b-2 border-[#dc2626]">
                                    <th class="px-6 py-4 text-left">No. PO</th>
                                    <th class="px-6 py-4 text-left">Supplier</th>
                                    <th class="px-6 py-4 text-left">Tanggal</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#374151]">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-[#dc2626]/10 transition">
                                        <td class="px-6 py-5">
                                            <div class="font-black text-[#facc15]">{{ $order->po_number }}</div>
                                            <div class="text-xs text-gray-400">by {{ $order->creator->name ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-5 font-bold">{{ $order->supplier->name ?? '-' }}</td>
                                        <td class="px-6 py-5 text-sm">
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                            <div class="text-xs text-gray-400">Est: {{ $order->expected_delivery_date ? \Carbon\Carbon::parse($order->expected_delivery_date)->format('d M Y') : '-' }}</div>
                                        </td>
                                        <td class="px-6 py-5">
                                            @switch($order->status)
                                                @case('pending')    <span class="px-4 py-1.5 bg-yellow-600/20 text-[#facc15] border border-[#facc15] rounded-full text-xs font-bold">MENUNGGU</span>@break
                                                @case('confirmed')  <span class="px-4 py-1.5 bg-blue-600/30 text-blue-300 border border-blue-500 rounded-full text-xs font-bold">KONFIRMASI</span>@break
                                                @case('shipped')    <span class="px-4 py-1.5 bg-purple-600/30 text-purple-300 border border-purple-500 rounded-full text-xs font-bold">DIKIRIM</span>@break
                                                @case('received')   <span class="px-4 py-1.5 bg-green-600 text-black rounded-full text-xs font-bold">DITERIMA</span>@break
                                                @default            <span class="px-4 py-1.5 bg-gray-600 text-gray-300 rounded-full text-xs font-bold">{{ strtoupper($order->status) }}</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <a href="{{ route('restock.show', $order) }}" class="px-5 py-2 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold text-sm rounded-lg transition">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-16 text-center text-gray-500 text-xl">Belum ada PO</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-[#111111]/50 border-t border-[#374151]">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>