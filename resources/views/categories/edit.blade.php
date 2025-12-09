<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">

                <div class="text-center mb-10">
                    <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Edit Kategori</h2>
                    <p class="text-gray-400 mt-2">Update kategori "{{ $category->name }}"</p>
                    <div class="w-32 h-1 bg-gradient-to-r from-[#dc2626] to-[#facc15] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <div class="bg-gradient-to-r from-[#dc2626] to-[#facc15] p-5 rounded-t-xl -m-8 mb-8">
                        <h3 class="text-2xl font-black uppercase text-black text-center">EDIT: {{ strtoupper($category->name) }}</h3>
                    </div>

                    <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <div class="space-y-8">

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Nama Kategori</label>
                                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-5 text-white">
                                @error('name') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Deskripsi</label>
                                <textarea name="description" rows="4"
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-5 text-white">{{ old('description', $category->description) }}</textarea>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-sm uppercase text-[#facc15] font-bold">Gambar Saat Ini</label>
                                @if($category->image_path)
                                    <img src="{{ Storage::url($category->image_path) }}" class="w-32 h-32 rounded-xl object-cover border-2 border-[#facc15] shadow-lg">
                                @else
                                    <div class="w-32 h-32 bg-[#374151] rounded-xl flex items-center justify-center text-gray-500 font-bold text-sm">NO IMAGE</div>
                                @endif

                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mt-6 mb-2">Ganti Gambar (Opsional)</label>
                                    <input type="file" name="image_path" accept="image/*"
                                        class="block w-full text-sm text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#dc2626] file:text-white hover:file:bg-[#ef4444]">
                                    @error('image_path') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-[#374151]">
                            <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Update Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>