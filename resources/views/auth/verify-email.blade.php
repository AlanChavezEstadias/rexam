<x-guest-layout>
    <div class="text-sonora-blanco">
        <!-- Icono y título -->
        <div class="flex flex-col items-center mb-8">
            <x-heroicon-o-envelope-open class="w-24 h-24 text-sonora-blanco" />
            <h2 class="mt-4 text-3xl font-bold">
                {{ __('Verifica tu correo electrónico') }}
            </h2>
        </div>

        <!-- Mensaje principal -->
        <div class="mb-6 text-sm leading-relaxed text-center text-sonora-blanco">
            {{ __('Gracias por registrarte. Antes de comenzar, confirma tu correo electrónico haciendo clic en el enlace que te enviamos.
                                    Si no recibiste el correo, podemos enviarte otro.') }}
        </div>

        <!-- Estado de sesión -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-400 text-center">
                {{ __('Un nuevo enlace de verificación ha sido enviado a tu correo electrónico.') }}
            </div>
        @endif

        <!-- Botones -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Reenviar -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-primary-button
                    class="w-full justify-center py-3 text-lg bg-sonora-naranja hover:bg-orange-600 text-white font-bold">
                    {{ __('Reenviar correo de verificación') }}
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
                @csrf
                <button type="submit"
                    class="text-sm underline text-sonora-blanco hover:text-gray-200 focus:outline-none">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
