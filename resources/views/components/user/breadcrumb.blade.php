<nav class="flex mb-4 text-sm text-gray-600" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1">
        <li>
            <a href="{{ route('user.dashboard') }}" class="flex items-center hover:text-sonora-naranja">
                <x-heroicon-o-home class="w-4 h-4 mr-1" />
                Inicio
            </a>
        </li>
        @isset($slot)
            <li>
                <span class="mx-2">/</span>
                {{ $slot }}
            </li>
        @endisset
    </ol>
</nav>
