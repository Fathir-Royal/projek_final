<nav class="h-full w-72 bg-gradient-to-b from-black to-gray-950 border-r-4 border-red-600 flex flex-col">

    <!-- Header Logo -->
    <div class="p-8 border-b-4 border-red-600 bg-gradient-to-r from-red-800 to-red-900">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-4">
            <div class="p-3 bg-yellow-500 rounded-2xl shadow-xl">
                <i class="fas fa-tools text-3xl text-black"></i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-white tracking-wider">MOTORMAX</h1>
                <p class="text-yellow-400 text-sm font-bold -mt-1">WMS</p>
            </div>
        </a>
    </div>

    <!-- Menu Items -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-3">

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white hover:shadow-xl hover:shadow-red-600/30 {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white shadow-xl' : 'text-gray-300' }}">
            <i class="fas fa-tachometer-alt text-xl"></i>
            Dashboard
        </x-nav-link>

        @if(in_array(Auth::user()->role, ['admin', 'manager']))
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white {{ request()->routeIs('categories.*') ? 'bg-red-600 text-white' : 'text-gray-300' }}">
                <i class="fas fa-folder-open text-xl"></i>
                Kategori Sparepart
            </x-nav-link>

            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')"
                class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white {{ request()->routeIs('products.*') ? 'bg-red-600 text-white' : 'text-gray-300' }}">
                <i class="fas fa-cogs text-xl"></i>
                Daftar Suku Cadang
            </x-nav-link>
        @endif

        @if(Auth::user()->role === 'admin')
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white {{ request()->routeIs('users.*') ? 'bg-red-600 text-white' : 'text-gray-300' }}">
                <i class="fas fa-users-cog text-xl"></i>
                Kelola Pengguna
            </x-nav-link>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'manager', 'staff']))
            <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')"
                class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white {{ request()->routeIs('transactions.*') ? 'bg-red-600 text-white' : 'text-gray-300' }}">
                <i class="fas fa-file-invoice-dollar text-xl"></i>
                Transaksi & Service
            </x-nav-link>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'manager', 'supplier']))
            <x-nav-link :href="route('restock.index')" :active="request()->routeIs('restock.*')"
                class="flex items-center gap-4 px-6 py-4 text-lg font-black rounded-2xl transition-all hover:bg-red-600 hover:text-white {{ request()->routeIs('restock.*') ? 'bg-red-600 text-white' : 'text-gray-300' }}">
                <i class="fas fa-truck-loading text-xl"></i>
                Restock & PO
            </x-nav-link>
        @endif

    </div>

    <!-- User Info & Logout -->
    <div class="border-t-4 border-red-600 bg-gradient-to-r from-gray-900 to-black p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="font-black text-white text-lg">{{ Auth::user()->name }}</p>
                <p class="text-yellow-500 text-sm font-bold uppercase tracking-wider">{{ Auth::user()->role }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="p-4 bg-red-600 hover:bg-red-700 rounded-2xl text-white transition transform hover:scale-110">
                    <i class="fas fa-sign-out-alt text-2xl"></i>
                </button>
            </form>
        </div>
    </div>
</nav>