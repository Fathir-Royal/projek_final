{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black px-4">
        <div class="w-full max-w-md">
            <!-- Logo & Judul -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-black text-red-600 tracking-wider">MOTORMAX</h1>
                <p class="text-xl font-bold text-gray-300 mt-2">Workshop Management System</p>
                <div class="flex justify-center mt-4">
                    <div class="w-32 h-1 bg-gradient-to-r from-red-600 to-yellow-500 rounded"></div>
                </div>
            </div>

            <div class="backdrop-blur-md bg-gray-900/90 border border-gray-700 rounded-2xl shadow-2xl p-8">
                <h3 class="text-2xl font-black text-white mb-8 text-center uppercase tracking-widest">Login Mekanik</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="mekanik@motormax.id"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-bold text-gray-300 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-5 py-4 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/30 transition" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label class="flex items-center text-sm text-gray-400">
                            <input type="checkbox" name="remember"
                                class="w-5 h-5 rounded border-gray-600 bg-gray-800 text-red-600 focus:ring-red-500">
                            <span class="ml-3">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-red-500 hover:text-yellow-500 font-bold">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-yellow-600 text-white font-black text-lg rounded-xl shadow-lg shadow-red-600/50 transform hover:scale-105 transition duration-200 uppercase tracking-wider">
                        Masuk Dashboard
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-gray-700 pt-6">
                    <p class="text-gray-400 text-sm">Belum punya akun bengkel?</p>
                    <a href="{{ route('register') }}" class="text-yellow-500 font-bold hover:text-yellow-400 text-lg">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>