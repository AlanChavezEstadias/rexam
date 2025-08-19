<x-layouts.super-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

        <x-super-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('super-admin.dashboard')],
            ['label' => 'Usuarios', 'url' => route('super-admin.users.index')],
            ['label' => 'Crear', 'url' => route('super-admin.users.create')],
        ]" />

        <div class="mt-6 bg-white shadow rounded p-6">
            <form method="POST" action="{{ route('super-admin.users.store') }}" autocomplete="off">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nickname -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nickname</label>
                        <input type="text" name="nickname" value="{{ old('nickname') }}" autocomplete="off"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Puede contener mayúsculas y minúsculas.</small>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" autocomplete="off"
                            style="text-transform: uppercase;"
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ\s]/gi, '')"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Solo letras y espacios.</small>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                    </div>

                    <!-- Contraseña + Generador -->
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <div class="flex mt-1 space-x-2">
                            <!-- Input con ojito -->
                            <div class="relative flex-1">
                                <input :type="show ? 'text' : 'password'" id="password" name="password"
                                    autocomplete="off"
                                    class="block w-full rounded border-gray-300 shadow-sm focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm pr-10">

                                <!-- Botón ojito -->
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                                    <!-- icons -->
                                </button>
                            </div>

                            <!-- Botón generar -->
                            <button type="button" onclick="generatePassword()"
                                class="px-3 py-2 text-sm font-medium text-white bg-sonora-naranja hover:bg-orange-600 rounded">
                                Generar
                            </button>
                        </div>
                    </div>

                    <!-- Confirmación de contraseña -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            autocomplete="off"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
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
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.super-admin>
