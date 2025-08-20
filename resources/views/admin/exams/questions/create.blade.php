<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Agregar Preguntas a {{ $exam->title }}</h1>

        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => $exam->title, 'url' => route('admin.exams.show', $exam)],
            ['label' => 'Preguntas'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6" x-data="{
        questions: [{
            text: '',
            type: 'multiple_choice',
            options: [{ text: '', is_correct: false }]
        }],

        setType(q, type) {
            q.type = type;
            if (type === 'true_false') {
                q.options = [
                    { text: 'Verdadero', is_correct: false },
                    { text: 'Falso', is_correct: false }
                ];
            } else {
                q.options = [{ text: '', is_correct: false }];
            }
        }
    }">

        <form action="{{ route('admin.exams.questions.store', $exam) }}" method="POST" class="space-y-6">
            @csrf

            <template x-for="(q, index) in questions" :key="index">
                <div class="bg-gray-50 border border-gray-200 rounded-xl shadow-sm p-6 mb-6 space-y-6">

                    <!-- Header -->
                    <div class="flex items-center justify-between border-b pb-2">
                        <h2 class="text-lg font-semibold text-gray-800">
                            Pregunta <span x-text="index + 1"></span>
                        </h2>
                        <button type="button" @click="questions.splice(index, 1)" x-show="questions.length > 1"
                            class="text-red-500 hover:text-red-700 text-sm font-medium">
                            ✕ Eliminar
                        </button>
                    </div>

                    <!-- Texto -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Texto de la pregunta</label>
                        <textarea :name="`questions[${index}][text]`" x-model="q.text" rows="2"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja"></textarea>
                    </div>

                    <!-- Tipo -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Tipo de pregunta</label>
                        <select :name="`questions[${index}][type]`" x-model="q.type"
                            @change="setType(q, $event.target.value)"
                            class="w-1/2 rounded-lg border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja">
                            <option value="multiple_choice">Opción múltiple</option>
                            <option value="true_false">Verdadero / Falso</option>
                        </select>
                    </div>

                    <!-- Opciones -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Opciones</label>

                        <template x-for="(opt, optIndex) in q.options" :key="optIndex">
                            <div class="flex items-center gap-3">
                                <input type="text" :readonly="q.type === 'true_false'"
                                    :name="`questions[${index}][options][${optIndex}][text]`" x-model="opt.text"
                                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:ring-sonora-naranja focus:border-sonora-naranja"
                                    :class="q.type === 'true_false' ? 'bg-gray-100 cursor-not-allowed w-1/4' : ''" />

                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox"
                                        :name="`questions[${index}][options][${optIndex}][is_correct]`"
                                        x-model="opt.is_correct"
                                        class="rounded border-gray-300 text-sonora-naranja focus:ring-sonora-naranja">
                                    <span class="ml-1">Correcta</span>
                                </label>

                                <button type="button" @click="q.options.splice(optIndex, 1)"
                                    x-show="q.type !== 'true_false' && q.options.length > 1"
                                    class="text-red-500 hover:text-red-700 text-sm">
                                    ✕
                                </button>
                            </div>
                        </template>

                        <!-- Botón añadir -->
                        <button type="button" @click="q.options.push({ text: '', is_correct: false })"
                            x-show="q.type === 'multiple_choice'"
                            class="text-green-600 text-sm font-medium hover:underline mt-1">
                            + Añadir opción
                        </button>
                    </div>
                </div>
            </template>

            <!-- Botones -->
            <div class="flex justify-between items-center mt-6">
                <button type="button"
                    @click="questions.push({ text: '', type: 'multiple_choice', options: [{ text: '', is_correct: false }] })"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    + Añadir otra pregunta
                </button>

                <div class="flex gap-3">
                    <a href="{{ route('admin.exams.questions.index', $exam) }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-sonora-naranja text-white rounded-lg shadow hover:bg-orange-600 transition">
                        Guardar preguntas
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
