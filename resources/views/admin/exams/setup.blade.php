<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Configurar Examen</h1>
        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => $exam->title, 'url' => route('admin.exams.show', $exam)],
            ['label' => 'Configuración'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.exams.setup.store', $exam) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Opciones de configuración --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start space-x-3">
                    <input type="checkbox" name="shuffle_questions" id="shuffle_questions" value="1"
                        {{ $exam->shuffle_questions ? 'checked' : '' }}
                        class="h-5 w-5 text-sonora-naranja border-gray-300 rounded focus:ring-sonora-naranja">
                    <label for="shuffle_questions" class="text-sm text-gray-700">
                        Barajar preguntas aleatoriamente en cada intento
                    </label>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" name="show_results" id="show_results" value="1"
                        {{ $exam->show_results ? 'checked' : '' }}
                        class="h-5 w-5 text-sonora-naranja border-gray-300 rounded focus:ring-sonora-naranja">
                    <label for="show_results" class="text-sm text-gray-700">
                        Mostrar resultado final al terminar el examen
                    </label>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" name="allow_review" id="allow_review" value="1"
                        {{ $exam->allow_review ? 'checked' : '' }}
                        class="h-5 w-5 text-sonora-naranja border-gray-300 rounded focus:ring-sonora-naranja">
                    <label for="allow_review" class="text-sm text-gray-700">
                        Permitir al estudiante revisar sus respuestas
                    </label>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" name="show_correct_answers" id="show_correct_answers" value="1"
                        {{ $exam->show_correct_answers ? 'checked' : '' }}
                        class="h-5 w-5 text-sonora-naranja border-gray-300 rounded focus:ring-sonora-naranja">
                    <label for="show_correct_answers" class="text-sm text-gray-700">
                        Mostrar cuáles eran las respuestas correctas
                    </label>
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
                    Guardar y continuar
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
