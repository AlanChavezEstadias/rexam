<x-guest-layout>
    <div class="text-sonora-blanco">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-8">
            <x-heroicon-o-key class="w-24 h-24 text-sonora-blanco" />
            <h2 class="mt-4 text-3xl font-bold">Restablecer contraseña</h2>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco">
                    <x-heroicon-o-envelope class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                        placeholder="Correo electrónico" required autofocus autocomplete="username"
                        class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sonora-blanco" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco relative">
                    <x-heroicon-o-lock-closed class="w-5 h-5 mr-2 text-sonora-blanco" />
                    <input id="password" type="password" name="password" placeholder="Nueva contraseña" required
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

            <!-- Confirm Password -->
            <div class="mb-6">
                <div
                    class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco relative">
                    <x-heroicon-o-lock-open class="w-5 h-5 mr-2 text-sonora-blanco" />
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
                    {{ __('Restablecer contraseña') }}
                </x-primary-button>
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
