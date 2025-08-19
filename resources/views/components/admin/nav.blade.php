<div x-data="{ sidebarOpen: true, userMenuOpen: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <nav :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="transition-all duration-300 bg-cover bg-center text-white flex flex-col"
        style="background-image: url('{{ asset('images/sistema/background-login.png') }}');">

        <!-- Logo + toggle -->
        <div class="flex items-center justify-between p-4 border-b border-white/30">
            <span x-show="sidebarOpen" class="text-lg font-bold">ADMIN</span>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded bg-black/30 hover:bg-black/50">
                <x-heroicon-o-chevron-left x-show="sidebarOpen" class="w-5 h-5 text-white" />
                <x-heroicon-o-chevron-right x-show="!sidebarOpen" class="w-5 h-5 text-white" />
            </button>
        </div>

        <!-- Menú -->
        <ul class="flex-1 p-4 space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 p-2 rounded hover:bg-black/30 {{ request()->routeIs('admin.dashboard') ? 'text-sonora-naranja font-semibold' : 'text-white hover:text-sonora-naranja' }}">
                    <x-heroicon-o-home
                        class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-sonora-naranja' : 'text-white group-hover:text-sonora-naranja' }}" />
                    <span x-show="sidebarOpen">Inicio</span>
                </a>
            </li>
        </ul>

        <!-- Footer con cerrar sesión -->
        <div class="p-4 border-t border-white/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-3 p-2 rounded hover:bg-black/30 w-full text-left">
                    <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5" />
                    <span x-show="sidebarOpen">Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="w-full bg-white shadow flex justify-end items-center px-4 py-3 md:px-6">
            <div class="relative">
                <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                        <x-heroicon-o-user class="h-6 w-6 text-gray-700" />
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <x-heroicon-o-chevron-down class="w-4 h-4 text-gray-600" />
                </button>

                <!-- Dropdown -->
                <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-600 hover:text-white">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Contenido dinámico -->
        <main class="flex-1 bg-gray-100 overflow-y-auto">
            <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
