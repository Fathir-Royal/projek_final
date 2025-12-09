<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h1 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Kategori Sparepart</h1>
                    <p class="text-gray-400 mt-2">Kelola semua kategori di MOTORMAX WMS</p>
                    <div class="w-40 h-1 bg-gradient-to-r from-[#dc2626] to-[#facc15] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border-2 border-[#374151] rounded-2xl shadow-2xl overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#dc2626] to-[#facc15] relative">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative flex flex-col md:flex-row justify-between items-center gap-4">
                            <div>
                                <h3 class="text-2xl font-black uppercase text-black">DAFTAR KATEGORI</h3>
                                <p class="text-black/80">Total: <span class="font-black">{{ $categories->total() }}</span> kategori</p>
                            </div>
                            <a href="{{ route('categories.create') }}" class="px-6 py-3 bg-black text-[#facc15] font-bold uppercase rounded-lg shadow-lg hover:bg-[#facc15] hover:text-black transition">
                                + Tambah Kategori
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#111111] text-[#facc15] text-xs uppercase font-bold">
                                <tr class="border-b-2 border-[#dc2626]">
                                    <th class="px-6 py-4 text-left">#</th>
                                    <th class="px-6 py-4 text-left">Gambar</th>
                                    <th class="px-6 py-4 text-left">Nama</th>
                                    <th class="px-6 py-4 text-left">Deskripsi</th>
                                    <th class="px-6 py-4 text-center">Item</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#374151]">
                                @forelse($categories as $category)
                                    <tr class="hover:bg-[#dc2626]/10 transition">
                                        <td class="px-6 py-5 text-gray-400 font-mono">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-5">
                                            @if($category->image_path)
                                                <img src="{{ Storage::url($category->image_path) }}" class="w-14 h-14 rounded-lg object-cover border border-[#facc15]">
                                            @else
                                                <div class="w-14 h-14 bg-[#374151] rounded-lg flex items-center justify-center text-xs">NO IMG</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 font-bold text-[#facc15]">{{ $category->name }}</td>
                                        <td class="px-6 py-5 text-gray-400 max-w-xs truncate">{{ $category->description ?? '-' }}</td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="px-4 py-1.5 bg-[#dc2626]/30 text-[#facc15] border border-[#facc15] rounded-full text-sm font-bold">
                                                {{ $category->products_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-center space-x-3">
                                            <a href="{{ route('categories.edit', $category) }}" class="inline-block p-2.5 bg-[#facc15] hover:bg-white text-black rounded-lg transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                                @csrf @method('DELETE')
                                                <button class="p-2.5 bg-[#dc2626] hover:bg-red-700 text-white rounded-lg transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-16 text-center">
                                            <p class="text-2xl text-gray-500 font-bold">Belum ada kategori</p>
                                            <a href="{{ route('categories.create') }}" class="mt-4 inline-block px-6 py-3 bg-[#dc2626] hover:bg-[#facc15] text-black font-bold rounded-lg">
                                                Buat Kategori Pertama
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-[#111111]/50 border-t border-[#374151]">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>