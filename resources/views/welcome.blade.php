<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MOTORMAX WMS - Workshop Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Rajdhani', sans-serif; }
        .bg-motor {
            background: linear-gradient(rgba(0,0,0,0.92), rgba(0,0,0,0.88)),
                        url('{{ asset('images/bengkel-motor.jpg') }}') center/cover no-repeat fixed;
        }
    </style>
</head>
<body class="h-full bg-motor text-white">

<div class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="px-8 py-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-5">
                <div class="p-3 bg-[#dc2626] rounded-xl shadow-xl border-4 border-[#facc15]">
                    <svg class="w-10 h-10" fill="none" stroke="#facc15" stroke-width="3" viewBox="0 0 24 24">
                        <path d="M9 17L5 13l8-8 8 8-4 4"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <div>
                    <h1 class="text-6xl font-black tracking-tight">
                        MOTOR<span class="text-[#facc15]">MAX</span>
                    </h1>
                    <p class="text-xl font-bold text-[#facc15] -mt-2">WORKSHOP MANAGEMENT SYSTEM</p>
                </div>
            </div>

            <div class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-10 py-4 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-bold text-xl uppercase rounded-xl shadow-xl transition hover:scale-105">
                        DASHBOARD
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-10 py-4 bg-white text-[#dc2626] font-black text-xl uppercase rounded-xl shadow-xl transition hover:scale-105">
                        LOGIN
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-8 py-4 border-4 border-[#facc15] font-bold text-xl uppercase rounded-xl hover:bg-[#facc15]/20 transition backdrop-blur">
                            DAFTAR
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main class="flex-1 flex items-center justify-center text-center px-8">
        <div class="max-w-5xl">
            <h2 class="text-7xl md:text-8xl font-black leading-tight mb-6">
                KELOLA BENGKELMU<br>
                <span class="text-[#facc15]">SEPERTI PRO</span>
            </h2>
            <p class="text-2xl opacity-90 mb-12 max-w-3xl mx-auto">
                Sistem manajemen stok & sparepart khusus bengkel motor — akurat, cepat, dan real-time.
            </p>

            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="px-20 py-8 bg-gradient-to-r from-[#dc2626] to-[#facc15] text-black font-black text-4xl uppercase rounded-2xl shadow-2xl transition hover:scale-110">
                    MASUK SEKARANG
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="px-8 py-6 border-t-4 border-[#facc15]/30">
        <div class="max-w-7xl mx-auto text-center text-lg opacity-80">
            © 2025 MOTORMAX WMS — Dibuat untuk bengkel motor terbaik di Indonesia
        </div>
    </footer>
</div>

</body>
</html>