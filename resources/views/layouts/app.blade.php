<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MOTORMAX WMS - Workshop Management System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|oswald:700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-black via-gray-900 to-black text-gray-100" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">

        <!-- SIDEBAR (Desktop + Mobile) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                class="fixed inset-y-0 left-0 z-50 w-72 bg-black/95 backdrop-blur-xl border-r-4 border-red-600 shadow-2xl transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0">
            @include('layouts.navigation')
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-black/70 lg:hidden" x-transition.opacity></div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0">

            <!-- Top Bar Mobile -->
            <header class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-black/90 backdrop-blur-md border-b-2 border-red-600 px-6 py-4 flex justify-between items-center flex shadow-2xl">
                <h1 class="text-2xl font-black tracking-wider">
                    MOTOR<span class="text-red-600">MAX</span>
                </h1>
                <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </header>

            <!-- Page Content -->
            <main class="flex-1 pt-20 lg:pt-8 pb-8 px-4 sm:px-6 lg:px-10">
                <div class="max-w-7xl mx-auto">

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-6 p-5 bg-gradient-to-r from-green-900/50 to-green-800/30 border border-green-600 rounded-2xl flex items-center shadow-xl">
                            <i class="fas fa-check-circle text-3xl text-green-400 mr-4"></i>
                            <div>
                                <p class="font-black text-green-300">BERHASIL!</p>
                                <p class="text-green-100">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-5 bg-gradient-to-r from-red-900/50 to-red-800/30 border border-red-600 rounded-2xl flex items-center shadow-xl">
                            <i class="fas fa-exclamation-triangle text-3xl text-red-400 mr-4"></i>
                            <div>
                                <p class="font-black text-red-300">GAGAL!</p>
                                <p class="text-red-100">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-5 bg-gradient-to-r from-yellow-900/50 to-orange-800/30 border-2 border-yellow-600 rounded-2xl shadow-xl">
                            <p class="font-black text-yellow-300 mb-2">ADA KESALAHAN INPUT:</p>
                            <ul class="list-disc list-inside text-yellow-100 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="border-t-4 border-red-600 bg-black/90 py-6 mt-auto">
                <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-center text-gray-400">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="font-bold">SYSTEM ONLINE</span>
                    </div>
                    <div class="mt-3 md:mt-0 font-mono text-sm">
                        © {{ date('Y') }} <span class="text-red-500 font-black">MOTORMAX WMS</span> • Hak Cipta Mekanik Sejati
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>