<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Crear Examen</h1>
        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => 'Crear'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.exams.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Título --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja"></textarea>
            </div>

            {{-- Campos pequeños en fila --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Preguntas por intento</label>
                    <input type="number" name="questions_per_attempt"
                        class="mt-1 block w-full md:w-32 rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                    <input type="number" name="duration_minutes"
                        class="mt-1 block w-full md:w-32 rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Máx. intentos</label>
                    <input type="number" name="max_attempts" value="1"
                        class="mt-1 block w-full md:w-24 rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Puntaje mínimo</label>
                    <input type="number" name="min_score_to_pass"
                        class="mt-1 block w-full md:w-32 rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>
            </div>

            {{-- Fechas en fila --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="available_from" class="block text-sm font-medium text-gray-700">Disponible desde</label>
                    <input type="text" id="available_from" name="available_from" data-datepicker
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>

                <div>
                    <label for="available_until" class="block text-sm font-medium text-gray-700">Disponible
                        hasta</label>
                    <input type="text" id="available_until" name="available_until" data-datepicker
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.exams.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-sonora-naranja text-white rounded-lg shadow hover:bg-orange-600 transition">
                    Guardar examen
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
