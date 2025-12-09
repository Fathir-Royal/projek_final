{{-- resources/views/auth/register.blade.php --}}

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black px-4">
        <div class="w-full max-w-lg">
            <div class="text-center mb-8">
                <h1 class="text-5xl font-black text-red-600 tracking-wider">MOTORMAX</h1>
                <p class="text-xl font-bold text-gray-300 mt-2">Workshop Management System</p>
                <div class="flex justify-center mt-4">
                    <div class="w-32 h-1 bg-gradient-to-r from-red-600 to-yellow-500 rounded"></div>
                </div>
            </div>

            <div class="backdrop-blur-md bg-gray-900/90 border border-gray-700 rounded-2xl shadow-2xl p-8">
                <h3 class="text-2xl font-black text-white mb-2 text-center uppercase tracking-widest">Daftar Bengkel</h3>
                <p class="text-center text-gray-400 text-sm mb-8">Hanya untuk pemilik bengkel / supplier resmi</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Nama Bengkel / Pemilik</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Bengkel Motor Jaya Abadi"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email Bengkel</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                            placeholder="info@jayaabadi.com"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-bold text-gray-300 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-300 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Ketik ulang password"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}"
                            class="flex-1 text-center py-4 border border-gray-600 text-gray-300 rounded-xl hover:bg-gray-800 transition font-bold">
                            Sudah punya akun?
                        </a>

                        <button type="submit"
                            class="flex-1 py-4 bg-gradient-to-r from-red-600 to-yellow-600 text-black font-black text-lg rounded-xl shadow-lg transform hover:scale-105 transition duration-200 uppercase tracking-wider">
                            Daftar Bengkel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>