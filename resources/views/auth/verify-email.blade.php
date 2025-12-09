{{-- resources/views/auth/verify-email.blade.php --}}

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-black px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-5xl font-black text-red-600 tracking-wider">MOTORMAX</h1>
                <p class="text-xl font-bold text-gray-300 mt-2">Workshop Management System</p>
            </div>

            <div class="backdrop-blur-md bg-gray-900/90 border-4 border-red-600 rounded-2xl shadow-2xl p-10 text-center">
                <i class="fas fa-envelope-open-text text-6xl text-yellow-500 mb-6"></i>
                <h3 class="text-3xl font-black text-white mb-6 uppercase">Verifikasi Email Bengkel</h3>

                <p class="text-gray-300 mb-6 leading-relaxed">
                    Terima kasih telah mendaftar di MOTORMAX WMS!<br>
                    Silakan cek email Anda dan klik link verifikasi yang kami kirim.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-900/50 border border-green-600 rounded-xl text-green-400 font-bold">
                        Link verifikasi baru telah dikirim!
                    </div>
                @endif

                <div class="flex flex-col gap-4 mt-8">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-4 bg-yellow-600 hover:bg-yellow-500 text-black font-black rounded-xl uppercase tracking-wider transform hover:scale-105 transition shadow-lg">
                            <i class="fas fa-redo mr-3"></i> Kirim Ulang Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 border border-gray-600 text-gray-400 hover:text-white hover:border-red-600 rounded-xl transition font-bold">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>