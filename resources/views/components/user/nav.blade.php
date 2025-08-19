<div x-data="{ userMenuOpen: false }" class="flex h-screen bg-gray-100">
    <!-- Contenido -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="w-full bg-sonora-guinda shadow flex justify-between items-center px-4 py-3 md:px-6">
            <!-- Logo o título -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('images/sistema/logo-centro.png') }}" alt="Logo Usuario" class="h-10 w-auto">
                </a>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('user.dashboard') }}"
                        class="text-sm pb-1 border-b-2 {{ request()->routeIs('user.dashboard')
                            ? 'border-sonora-naranja text-sonora-naranja font-semibold'
                            : 'border-transparent text-white hover:text-sonora-naranja hover:border-sonora-naranja' }}">
                        Inicio
                    </a>
                </nav>
            </div>

            <!-- Dropdown Usuario -->
            <div class="relative">
                <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                        <x-heroicon-o-user class="h-6 w-6 text-gray-700" />
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        @if (Auth::user()->email)
                            <p class="text-xs text-gray-200">{{ Auth::user()->email }}</p>
                        @endif
                    </div>
                    <x-heroicon-o-chevron-down class="w-4 h-4 text-white" />
                </button>

                <!-- Dropdown -->
                <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-gray-700">
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
