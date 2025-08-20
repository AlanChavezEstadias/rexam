<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Pasos previos de {{ $exam->title }}</h1>

        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => $exam->title, 'url' => route('admin.exams.show', $exam)],
            ['label' => 'Pasos previos'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.exams.steps.create', $exam) }}"
                class="px-4 py-2 bg-sonora-naranja text-white rounded-lg shadow hover:bg-orange-600 transition">
                + Agregar paso
            </a>

            {{-- Botón para ir a la previsualización SOLO si hay pasos --}}
            @if ($steps->count() > 0)
                <a href="{{ route('admin.exams.preview', $exam) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    👁️ Previsualizar examen
                </a>
            @endif
        </div>

        @if ($steps->isEmpty())
            <p class="text-gray-500 text-center py-8">No hay pasos previos registrados para este examen.</p>
        @else
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($steps as $step)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $step->title }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs bg-gray-200 rounded">{{ ucfirst($step->type) }}</span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.exams.steps.edit', [$exam, $step]) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.exams.steps.destroy', [$exam, $step]) }}" method="POST"
                                    class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este paso?')">
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
