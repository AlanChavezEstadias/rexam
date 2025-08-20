<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Panel de Administrador</h1>
        <x-admin.breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')]]" />
    </div>

    <div class="px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        {{-- Card: Exámenes --}}
        <a href="{{ route('admin.exams.index') }}"
            class="bg-white shadow-md rounded-lg p-6 flex items-center gap-4 hover:shadow-lg transition">
            <x-heroicon-o-academic-cap class="w-12 h-12 text-sonora-naranja" />
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Exámenes</h2>
                <p class="text-sm text-gray-600">Gestiona y crea nuevos exámenes.</p>
            </div>
        </a>
    </div>
</x-layouts.admin>
