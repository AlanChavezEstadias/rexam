<x-layouts.admin>
    <div class="max-w-5xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Pasos previos: {{ $exam->title }}</h1>

        <div x-data="{ step: 0, total: {{ $steps->count() }} }"
            x-effect="
                // Cada vez que cambia el paso, pausamos los reproductores
                $el.querySelectorAll('[data-step]').forEach((el, i) => {
                    if (i !== step) {
                        // Videos locales
                        el.querySelectorAll('video').forEach(v => { v.pause(); v.currentTime = 0; });
                        // Audios
                        el.querySelectorAll('audio').forEach(a => { a.pause(); a.currentTime = 0; });
                        // Iframes (YouTube, links, etc.)
                        el.querySelectorAll('iframe').forEach(f => {
                            const src = f.getAttribute('src');
                            f.setAttribute('src', src); // reload para cortar reproducción
                        });
                    }
                });
            ">

            {{-- Barra de progreso --}}
            <div class="w-full bg-gray-200 rounded-full h-3 mb-6">
                <div class="bg-green-600 h-3 rounded-full" :style="`width: ${(step+1)/total*100}%`"></div>
            </div>

            {{-- Render de cada paso --}}
            @foreach ($steps as $index => $s)
                <div x-show="step === {{ $index }}" data-step class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">
                        Paso {{ $index + 1 }}: {{ $s->title }}
                    </h2>
                    <p class="text-gray-600 mb-4">{{ $s->description }}</p>

                    {{-- Mostrar contenido según tipo --}}
                    @if ($s->type === 'text')
                        <p class="p-4 bg-gray-100 rounded">{{ $s->content }}</p>
                    @elseif($s->type === 'document')
                        @php $extension = pathinfo($s->content, PATHINFO_EXTENSION); @endphp
                        @if (strtolower($extension) === 'pdf')
                            <iframe src="{{ asset('storage/' . rawurlencode($s->content)) }}"
                                class="w-full h-[80vh] border rounded"></iframe>
                        @else
                            <p class="text-gray-500">Documento: {{ $s->content }}</p>
                        @endif
                        <a href="{{ asset('storage/' . rawurlencode($s->content)) }}" target="_blank" download
                            class="mt-2 inline-block px-3 py-2 bg-blue-600 text-white rounded">
                            ⬇ Descargar documento
                        </a>
                    @elseif($s->type === 'video')
                        <video controls class="w-full h-[70vh] rounded shadow">
                            <source src="{{ asset('storage/' . rawurlencode($s->content)) }}">
                            Tu navegador no soporta video.
                        </video>
                        <a href="{{ asset('storage/' . rawurlencode($s->content)) }}" download
                            class="mt-2 inline-block px-3 py-2 bg-blue-600 text-white rounded">
                            ⬇ Descargar video
                        </a>
                    @elseif($s->type === 'video_url')
                        @php
                            $url = $s->content;
                            if (strpos($url, 'youtube.com/watch?v=') !== false) {
                                $videoId = explode('v=', $url)[1];
                                $videoId = explode('&', $videoId)[0];
                                $url = 'https://www.youtube.com/embed/' . $videoId;
                            }
                            if (strpos($url, 'youtu.be/') !== false) {
                                $videoId = explode('youtu.be/', $url)[1];
                                $videoId = explode('?', $videoId)[0];
                                $url = 'https://www.youtube.com/embed/' . $videoId;
                            }
                        @endphp
                        <iframe width="100%" height="600" src="{{ $url }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <p class="mt-2">
                            <a href="{{ $s->content }}" target="_blank" class="text-blue-600 underline">
                                🔗 Ver en YouTube
                            </a>
                        </p>
                    @elseif($s->type === 'image')
                        <img src="{{ asset('storage/' . rawurlencode($s->content)) }}"
                            class="w-full max-h-[80vh] object-contain rounded shadow">
                        <a href="{{ asset('storage/' . rawurlencode($s->content)) }}" download
                            class="mt-2 inline-block px-3 py-2 bg-blue-600 text-white rounded">
                            ⬇ Descargar imagen
                        </a>
                    @elseif($s->type === 'audio')
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . rawurlencode($s->content)) }}" type="audio/mpeg">
                            Tu navegador no soporta audio.
                        </audio>
                        <a href="{{ asset('storage/' . rawurlencode($s->content)) }}" download
                            class="mt-2 inline-block px-3 py-2 bg-blue-600 text-white rounded">
                            ⬇ Descargar audio
                        </a>
                    @elseif($s->type === 'link')
                        <iframe src="{{ $s->content }}" class="w-full h-[80vh] border rounded"></iframe>
                        <p class="mt-2">
                            <a href="{{ $s->content }}" target="_blank" class="text-blue-600 underline">
                                🔗 Abrir en nueva pestaña
                            </a>
                        </p>
                    @endif

                    {{-- Botones de navegación --}}
                    <div class="mt-6 flex justify-between">
                        <button x-show="step > 0" @click="step--" class="px-4 py-2 bg-gray-300 rounded">
                            ← Anterior
                        </button>

                        <button x-show="step < total - 1" @click="step++"
                            class="px-4 py-2 bg-green-600 text-white rounded">
                            Confirmar y siguiente →
                        </button>

                        <button x-show="step === total - 1" class="px-4 py-2 bg-blue-600 text-white rounded"
                            @click="alert('Fin del wizard. Aquí iría el examen.')">
                            Terminar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.admin>
