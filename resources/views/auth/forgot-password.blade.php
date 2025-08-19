<div class="text-sonora-blanco">
    <!-- Icono y título -->
    <div class="flex flex-col items-center mb-8">
        <x-heroicon-o-key class="w-24 h-24 text-sonora-blanco" />
        <h2 class="mt-4 text-3xl font-bold">
            {{ __('Recuperar contraseña') }}
        </h2>
    </div>

    <!-- Texto introductorio -->
    <div class="mb-6 text-sm leading-relaxed text-center text-sonora-blanco">
        {{ __('¿Olvidaste tu contraseña? No te preocupes. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400 text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email -->
        <div class="mb-6">
            <div
                class="flex items-center border-b border-sonora-blanco focus-within:border-2 focus-within:border-sonora-blanco">
                <x-heroicon-o-envelope class="w-5 h-5 mr-2 text-sonora-blanco" />
                <input id="email" type="email" wire:model="email" name="email" placeholder="Correo electrónico"
                    required autofocus
                    class="w-full bg-transparent border-none focus:ring-0 focus:outline-none py-2 text-sm text-sonora-blanco placeholder-sonora-blanco" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sonora-blanco" />
        </div>

        <!-- Botón -->
        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center py-3 text-lg bg-sonora-naranja hover:bg-orange-600 text-white font-bold">
                {{ __('Enviar enlace de restablecimiento') }}
            </x-primary-button>
        </div>
    </form>
</div>
