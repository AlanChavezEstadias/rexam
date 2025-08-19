<x-guest-layout>
    <div class="text-sonora-blanco">
        <!-- Título -->
        <div class="flex flex-col items-center mb-8">
            <x-heroicon-o-user-plus class="w-24 h-24 text-sonora-blanco" />
            <h2 class="mt-4 text-3xl font-bold">REGISTRO</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco">
                    <x-heroicon-o-user class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="name" type="text" name="name" placeholder="Nombre completo"
                        value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Email -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco">
                    <x-heroicon-o-envelope class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="email" type="email" name="email" placeholder="Correo electrónico"
                        value="{{ old('email') }}" required autocomplete="username"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Contraseña -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco relative">
                    <x-heroicon-o-lock-closed class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="password" type="password" name="password" placeholder="Contraseña" required
                        autocomplete="new-password"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco pr-10" />

                    <!-- Toggle -->
                    <button type="button" onclick="togglePassword('password')"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-sonora-blanco focus:outline-none">
                        <x-heroicon-o-eye id="icon-eye-password" class="w-5 h-5 hidden" />
                        <x-heroicon-o-eye-slash id="icon-eye-slash-password" class="w-5 h-5" />
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco relative">
                    <x-heroicon-o-lock-closed class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Confirmar contraseña" required autocomplete="new-password"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco pr-10" />

                    <!-- Toggle -->
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-sonora-blanco focus:outline-none">
                        <x-heroicon-o-eye id="icon-eye-password_confirmation" class="w-5 h-5 hidden" />
                        <x-heroicon-o-eye-slash id="icon-eye-slash-password_confirmation" class="w-5 h-5" />
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Botón -->
            <div class="mt-8">
                <x-primary-button
                    class="w-full justify-center py-3 text-lg bg-sonora-naranja hover:bg-orange-600 text-white font-bold">
                    {{ __('Registrarme') }}
                </x-primary-button>
            </div>

            <!-- Link a login -->
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}"
                    class="text-sm underline text-sonora-blanco hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sonora-naranja">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eye = document.getElementById('icon-eye-' + id);
            const eyeSlash = document.getElementById('icon-eye-slash-' + id);

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
