<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Preguntas de {{ $exam->title }}</h1>

        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => $exam->title, 'url' => route('admin.exams.show', $exam)],
            ['label' => 'Preguntas'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.exams.questions.create', $exam) }}"
                class="px-4 py-2 bg-sonora-naranja text-white rounded-lg shadow hover:bg-orange-600 transition">
                + Agregar pregunta
            </a>

            {{-- Botón siguiente paso SOLO si hay preguntas --}}
            @if ($questions->count() > 0)
                <a href="{{ route('admin.exams.steps.index', $exam) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    Continuar a pasos previos
                </a>
            @endif
        </div>

        @if ($questions->isEmpty())
            <p class="text-gray-500 text-center py-8">No hay preguntas registradas para este examen.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Pregunta</th>
                        <th class="px-4 py-2 text-left">Tipo</th>
                        <th class="px-4 py-2 text-left">Opciones</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $question->question_text }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs bg-gray-200">
                                    {{ $question->type === 'multiple_choice' ? 'Opción múltiple' : 'Verdadero/Falso' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <ul class="space-y-1">
                                    @foreach ($question->answers as $answer)
                                        <li
                                            class="{{ $answer->is_correct ? 'text-green-600 font-semibold' : 'text-red-600' }}">
                                            {{ $answer->answer_text }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.exams.questions.edit', [$exam, $question]) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.exams.questions.destroy', [$exam, $question]) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta pregunta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layouts.admin>
