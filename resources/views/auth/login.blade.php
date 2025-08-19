<x-guest-layout>
    <div class="text-sonora-blanco">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-8">
            <x-heroicon-o-user-circle class="w-32 h-32 text-sonora-blanco" />
            <h2 class="mt-4 text-3xl font-bold">
                INICIO DE SESIÓN
            </h2>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco">
                    <x-heroicon-o-user class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="login" type="text" name="login" placeholder="Usuario o Email"
                        value="{{ old('login') }}" required autofocus autocomplete="username"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm placeholder-sonora-blanco text-sonora-blanco" />
                </div>
                <x-input-error :messages="$errors->get('login')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Contraseña -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco relative">
                    <x-heroicon-o-lock-closed class="w-5 h-5 mr-2 text-sonora-blanco" />

                    <!-- Input -->
                    <input id="password" type="password" name="password" placeholder="Contraseña" required
                        autocomplete="current-password"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm placeholder-sonora-blanco text-sonora-blanco pr-10" />

                    <!-- Botón para mostrar/ocultar -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-sonora-blanco focus:outline-none">
                        <x-heroicon-o-eye id="icon-eye" class="w-5 h-5 hidden" />
                        <x-heroicon-o-eye-slash id="icon-eye-slash" class="w-5 h-5" />
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-sonora-naranja focus:ring-sonora-naranja">
                <label for="remember_me" class="ml-2 text-sm text-sonora-blanco">
                    {{ __('Recordarme') }}
                </label>
            </div>

            <!-- Botón ancho -->
            <div class="mt-8">
                <x-primary-button
                    class="w-full justify-center py-3 text-lg bg-sonora-naranja hover:bg-orange-600 text-white font-bold">
                    {{ __('Ingresar') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eye = document.getElementById('icon-eye');
            const eyeSlash = document.getElementById('icon-eye-slash');

            if (input.type === "password") {
                input.type = "text";
                eye.classList.remove('hidden');
                eyeSlash.classList.add('hidden');
            } else {
                input.type = "password";
                eye.classList.add('hidden');
                eyeSlash.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
