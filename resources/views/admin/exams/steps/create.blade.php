<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Agregar paso multimedia a {{ $exam->title }}</h1>

        <x-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Exámenes', 'url' => route('admin.exams.index')],
            ['label' => $exam->title, 'url' => route('admin.exams.show', $exam)],
            ['label' => 'Pasos previos', 'url' => route('admin.exams.steps.index', $exam)],
            ['label' => 'Crear'],
        ]" />
    </div>

    <div class="px-6 mt-6 bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.exams.steps.store', $exam) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            {{-- Título --}}
            <div>
                <label for="title" class="block font-medium">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border rounded px-3 py-2" required>
                @error('title')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label for="description" class="block font-medium">Descripción</label>
                <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>

            {{-- Tipo --}}
            <div>
                <label for="type" class="block font-medium">Tipo de contenido</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2" required
                    onchange="toggleFields()">
                    <option value="">Seleccione...</option>
                    <option value="text">Texto</option>
                    <option value="document">Documento (PDF, Word, Excel...)</option>
                    <option value="video">Video (archivo)</option>
                    <option value="video_url">Video (URL)</option>
                    <option value="image">Imagen</option>
                    <option value="audio">Audio</option>
                    <option value="link">Enlace</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo de texto --}}
            <div id="field-text" class="hidden">
                <label class="block font-medium">Contenido en texto</label>
                <textarea name="content" rows="4" class="w-full border rounded px-3 py-2">{{ old('content') }}</textarea>
            </div>

            {{-- Campo de URL --}}
            <div id="field-url" class="hidden">
                <label class="block font-medium">URL</label>
                <input type="url" name="content_url" class="w-full border rounded px-3 py-2"
                    placeholder="https://..." value="{{ old('content_url') }}">
            </div>

            {{-- Campo de archivo --}}
            <div id="field-file" class="hidden">
                <label class="block font-medium">Subir archivo</label>
                <input type="file" name="file" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Orden --}}
            <div>
                <label for="order" class="block font-medium">Orden</label>
                <input type="number" name="order" id="order"
                    value="{{ old('order', $exam->steps->count() + 1) }}" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.exams.steps.index', $exam) }}"
                    class="px-4 py-2 bg-gray-300 rounded">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-sonora-naranja text-white rounded hover:bg-orange-600">
                    Guardar paso
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleFields() {
            const type = document.getElementById('type').value;
            document.getElementById('field-text').classList.add('hidden');
            document.getElementById('field-url').classList.add('hidden');
            document.getElementById('field-file').classList.add('hidden');

            if (type === 'text') document.getElementById('field-text').classList.remove('hidden');
            if (['document', 'video', 'image', 'audio'].includes(type)) {
                document.getElementById('field-file').classList.remove('hidden');
            }
            if (['video_url', 'link'].includes(type)) {
                document.getElementById('field-url').classList.remove('hidden');
            }
        }
    </script>
</x-layouts.admin>
