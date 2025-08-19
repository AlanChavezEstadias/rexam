<x-layouts.super-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

        <x-super-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('super-admin.dashboard')],
            ['label' => 'Usuarios', 'url' => route('super-admin.users.index')],
            ['label' => 'Editar', 'url' => route('super-admin.users.edit', $user->id)],
        ]" />

        <div class="mt-6 bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('super-admin.users.update', $user->id) }}" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nickname -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nickname</label>
                        <input type="text" name="nickname" value="{{ old('nickname', $user->nickname) }}"
                            autocomplete="off" required
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" autocomplete="off"
                            required style="text-transform: uppercase;"
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ\s]/gi, '')"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Solo letras y espacios.</small>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="off"
                            required
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                    </div>

                    <!-- Contraseña (opcional) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contraseña (opcional)</label>
                        <input type="password" name="password" autocomplete="off"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Déjalo vacío si no deseas cambiarla.</small>
                    </div>

                    <!-- Confirmación contraseña -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" autocomplete="off"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('super-admin.users.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-sonora-naranja hover:bg-orange-600 rounded">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.super-admin>
