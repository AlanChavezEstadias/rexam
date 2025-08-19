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
                        <input type="text" name="nickname" value="{{ old('nickname') }}" autocomplete="off" required
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Puede contener mayúsculas y minúsculas.</small>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" autocomplete="off" required
                            style="text-transform: uppercase;"
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÁÉÍÓÚÑ\s]/gi, '')"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                        <small class="text-gray-500 text-xs">Solo letras y espacios.</small>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="off" required
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm
                                   focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm">
                    </div>

                    <!-- Contraseña + Generador -->
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <div class="flex mt-1 space-x-2">
                            <!-- Input con ojito -->
                            <div class="relative flex-1">
                                <input :type="show ? 'text' : 'password'" id="password" name="password"
                                    autocomplete="off" required minlength="8"
                                    class="block w-full rounded border-gray-300 shadow-sm
                                           focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm pr-10"
                                    oninput="validatePassword(this.value)">

                                <!-- Botón ojito -->
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.974 9.974 0 012.223-3.592M6.5 6.5L17.5 17.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Botón generar -->
                            <button type="button" onclick="generatePassword()"
                                class="px-3 py-2 text-sm font-medium text-white bg-sonora-naranja hover:bg-orange-600 rounded">
                                Generar
                            </button>
                        </div>

                        <!-- Validación de seguridad -->
                        <ul class="mt-3 text-xs space-y-1">
                            <li id="val-length" class="flex items-center text-red-500">❌ Mínimo 8 caracteres</li>
                            <li id="val-upper" class="flex items-center text-red-500">❌ Una mayúscula</li>
                            <li id="val-lower" class="flex items-center text-red-500">❌ Una minúscula</li>
                            <li id="val-number" class="flex items-center text-red-500">❌ Un número</li>
                            <li id="val-symbol" class="flex items-center text-red-500">❌ Un símbolo</li>
                        </ul>
                    </div>

                    <!-- Confirmación de contraseña -->
                    <div x-data="{ showConfirm: false }">
                        <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <div class="relative mt-1">
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                id="password_confirmation" autocomplete="off" required
                                class="block w-full rounded border-gray-300 shadow-sm
                                       focus:border-sonora-naranja focus:ring-sonora-naranja sm:text-sm pr-10">

                            <!-- Ojito -->
                            <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                                <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.974 9.974 0 012.223-3.592M6.5 6.5L17.5 17.5" />
                                </svg>
                            </button>
                        </div>
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

    <!-- Scripts -->
    <script>
        function generatePassword() {
            const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const lower = "abcdefghijklmnopqrstuvwxyz";
            const numbers = "0123456789";
            const symbols = "!@#$%^&*()_+[]{}|;:,.<>?";
            const all = upper + lower + numbers + symbols;

            let password = "";
            password += upper[Math.floor(Math.random() * upper.length)];
            password += lower[Math.floor(Math.random() * lower.length)];
            password += numbers[Math.floor(Math.random() * numbers.length)];
            password += symbols[Math.floor(Math.random() * symbols.length)];

            for (let i = password.length; i < 12; i++) {
                password += all[Math.floor(Math.random() * all.length)];
            }

            // Mezclar caracteres
            password = password.split('').sort(() => Math.random() - 0.5).join('');

            document.getElementById("password").value = password;
            document.getElementById("password_confirmation").value = password;

            validatePassword(password);
        }

        function validatePassword(value) {
            updateValidation("val-length", value.length >= 8, "Mínimo 8 caracteres");
            updateValidation("val-upper", /[A-Z]/.test(value), "Una mayúscula");
            updateValidation("val-lower", /[a-z]/.test(value), "Una minúscula");
            updateValidation("val-number", /[0-9]/.test(value), "Un número");
            updateValidation("val-symbol", /[^A-Za-z0-9]/.test(value), "Un símbolo");
        }

        function updateValidation(id, condition, text) {
            const el = document.getElementById(id);
            el.textContent = (condition ? "✅ " : "❌ ") + text;
            el.className = condition ? "flex items-center text-green-600" : "flex items-center text-red-500";
        }
    </script>
</x-layouts.super-admin>
