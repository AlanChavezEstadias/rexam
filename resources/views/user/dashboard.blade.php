<x-layouts.user-layout>
    <div class="px-6 py-4">
        <!-- Encabezado -->
        <h1 class="text-2xl font-bold">Panel de Usuario</h1>
        <x-user.breadcrumb :items="[['label' => 'Dashboard', 'url' => route('user.dashboard')]]" />

        <hr class="my-4">

        <!-- Contenido en Cards -->
        <div class="mt-6 ml-8">
            <!-- Grid con máximo 3 columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold">Sección 1</h2>
                    <p class="text-sm text-gray-600">Ejemplo de contenido en una tarjeta.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold">Sección 2</h2>
                    <p class="text-sm text-gray-600">Otra tarjeta con información adicional.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold">Sección 3</h2>
                    <p class="text-sm text-gray-600">Una tercera tarjeta dentro del dashboard.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.user-layout>
