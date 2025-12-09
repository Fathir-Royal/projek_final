<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-3xl mx-auto px-6 lg:px-8">

                <div class="mb-8">
                    <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Tambah Pengguna Baru</h2>
                    <p class="text-gray-400 mt-1">Staff, mekanik, manager, atau admin</p>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="space-y-7">

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white placeholder-[#64748b]">
                                @error('name') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white placeholder-[#64748b]">
                                @error('email') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Jabatan</label>
                                <select name="role" required class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 font-medium">
                                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                                    <option value="staff" {{ old('role')=='staff'?'selected':'' }}>Staff Gudang</option>
                                    <option value="manager" {{ old('role')=='manager'?'selected':'' }}>Manager Bengkel</option>
                                    <option value="supplier" {{ old('role')=='supplier'?'selected':'' }}>Supplier</option>
                                    <option value="admin" {{ old('role')=='admin'?'selected':'' }}>System Admin</option>
                                </select>
                                @error('role') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Password</label>
                                    <input type="password" name="password" required autocomplete="new-password"
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                    @error('password') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-[#374151]">
                            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Buat Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>