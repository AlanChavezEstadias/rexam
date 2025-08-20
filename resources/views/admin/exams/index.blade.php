<x-layouts.admin>
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Listado de Exámenes</h1>
            <x-admin.breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Exámenes']]" />
        </div>

        {{-- Botón: Crear nuevo examen --}}
        <a href="{{ route('admin.exams.create') }}"
            class="inline-flex items-center px-4 py-2 bg-sonora-naranja text-white text-sm font-medium rounded-lg shadow hover:bg-orange-600 transition">
            <x-heroicon-o-plus class="w-5 h-5 mr-2" />
            Crear nuevo examen
        </a>
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <p class="text-gray-600">Aquí aparecerán los exámenes creados.</p>
    </div>
</x-layouts.admin>
