<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0f0f0f] via-[#111111] to-[#1a1a1a] text-gray-100">
        <div class="py-10">
            <div class="max-w-3xl mx-auto px-6 lg:px-8">

                <div class="mb-8">
                    <h2 class="text-4xl font-black uppercase tracking-tight text-[#facc15]">Edit Pengguna</h2>
                    <p class="text-gray-400 mt-1">Update data {{ $user->name }}</p>
                </div>

                <div class="backdrop-blur-lg bg-[#1f2937]/90 border border-[#374151] rounded-2xl shadow-2xl p-8">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf @method('PUT')

                        <div class="space-y-7">

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                @error('name') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 text-white">
                                @error('email') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm uppercase text-[#facc15] font-bold mb-2">Jabatan</label>
                                <select name="role" required class="w-full bg-[#111111] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4 font-medium">
                                    <option value="staff" {{ old('role',$user->role)=='staff'?'selected':'' }}>Staff Gudang</option>
                                    <option value="manager" {{ old('role',$user->role)=='manager'?'selected':'' }}>Manager Bengkel</option>
                                    <option value="supplier" {{ old('role',$user->role)=='supplier'?'selected':'' }}>Supplier</option>
                                    <option value="admin" {{ old('role',$user->role)=='admin'?'selected':'' }}>System Admin</option>
                                </select>
                                @error('role') <p class="text-[#dc2626] text-sm mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div class="h-px bg-gradient-to-r from-[#dc2626] via-[#facc15] to-[#dc2626] my-8"></div>

                            <div class="bg-[#111111]/50 border border-[#374151] rounded-xl p-6">
                                <p class="text-[#facc15] font-bold mb-4">Ganti Password (Opsional)</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm text-gray-400 mb-2">Password Baru</label>
                                        <input type="password" name="password" autocomplete="new-password"
                                            class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-400 mb-2">Konfirmasi</label>
                                        <input type="password" name="password_confirmation"
                                            class="w-full bg-[#0f0f0f] border border-[#374151] focus:border-[#facc15] rounded-lg py-3 px-4">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-[#374151]">
                            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-[#374151] hover:bg-[#4b5563] text-white font-bold rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black uppercase rounded-lg shadow-lg transition hover:scale-105">
                                Update Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>