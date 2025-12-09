<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-600/20 border border-green-500 rounded-lg text-green-300 font-bold backdrop-blur">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl shadow-2xl overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] relative">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative flex justify-between items-center">
                            <div>
                                <h3 class="text-3xl font-black uppercase text-white">Manajemen Pengguna</h3>
                                <p class="text-white/80">Atur akses tim bengkel</p>
                            </div>
                            <a href="{{ route('users.create') }}" class="px-6 py-3 bg-black text-[#facc15] font-bold uppercase rounded-lg shadow-lg hover:bg-[#facc15] hover:text-black transition">
                                + Tambah User
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#111111] text-[#facc15] text-xs uppercase font-bold">
                                <tr class="border-b-2 border-[#dc2626]">
                                    <th class="px-6 py-4 text-left">Nama</th>
                                    <th class="px-6 py-4 text-left">Email</th>
                                    <th class="px-6 py-4 text-left">Jabatan</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#374151]">
                                @forelse($users as $user)
                                    <tr class="hover:bg-[#dc2626]/10 transition">
                                        <td class="px-6 py-5">
                                            <div class="font-bold text-[#facc15]">{{ $user->name }}</div>
                                            @if(Auth::id() === $user->id)<span class="text-xs text-green-400">(Kamu)</span>@endif
                                        </td>
                                        <td class="px-6 py-5 text-gray-300">{{ $user->email }}</td>
                                        <td class="px-6 py-5">
                                            @switch($user->role)
                                                @case('admin')    <span class="px-4 py-1.5 bg-red-600/30 border border-red-500 text-red-300 rounded-full text-xs font-bold">ADMIN</span>@break
                                                @case('manager')  <span class="px-4 py-1.5 bg-orange-600/30 border border-orange-500 text-orange-300 rounded-full text-xs font-bold">MANAGER</span>@break
                                                @case('staff')    <span class="px-4 py-1.5 bg-blue-600/30 border border-blue-500 text-blue-300 rounded-full text-xs font-bold">STAFF</span>@break
                                                @case('supplier') <span class="px-4 py-1.5 bg-purple-600/30 border border-purple-500 text-purple-300 rounded-full text-xs font-bold">SUPPLIER</span>@break
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="px-4 py-1.5 text-xs font-bold rounded-full {{ $user->status=='approved' ? 'bg-green-600 text-black' : 'bg-yellow-600 text-black' }}">
                                                {{ $user->status=='approved' ? 'AKTIF' : 'PENDING' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <div class="flex justify-center gap-3">
                                                <a href="{{ route('users.edit', $user) }}" class="px-5 py-2 bg-[#facc15] hover:bg-white text-black font-bold text-sm rounded-lg transition">
                                                    Edit
                                                </a>
                                                @if(Auth::id() !== $user->id)
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                                        @csrf @method('DELETE')
                                                        <button class="px-5 py-2 bg-[#dc2626] hover:bg-red-700 text-white font-bold text-sm rounded-lg transition">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-16 text-center text-gray-500 text-xl">Belum ada pengguna</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-[#111111]/50 border-t border-[#374151]">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>