<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MOTORMAX WMS - Login Bengkel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|oswald:700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-black via-gray-900 to-black min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <!-- Logo Atas -->
        <div class="text-center mb-10">
            <div class="inline-block p-6 bg-gradient-to-br from-red-600 to-red-800 rounded-3xl shadow-2xl border-4 border-yellow-500">
                <i class="fas fa-motorcycle text-6xl text-yellow-400"></i>
            </div>
            <h1 class="text-6xl font-black text-white mt-6 tracking-wider">
                MOTOR<span class="text-red-600">MAX</span>
            </h1>
            <p class="text-xl text-gray-400 font-bold mt-2">Workshop Management System</p>
            <div class="w-48 h-1 bg-gradient-to-r from-red-600 to-yellow-500 mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Form Card -->
        <div class="backdrop-blur-xl bg-gray-900/95 border-4 border-red-600 rounded-3xl shadow-2xl overflow-hidden">
            {{ $slot }}
        </div>

        <!-- Footer Kecil -->
        <p class="text-center text-gray-500 text-sm mt-8">
            © {{ date('Y') }} MOTORMAX WMS • Akses Khusus Mekanik & Supplier
        </p>
    </div>

</body>
</html>