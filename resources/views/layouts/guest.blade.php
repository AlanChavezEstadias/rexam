<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center"
    style="background-image: url('{{ asset('images/sistema/background-login.png') }}')">

    <div class="min-h-screen flex">
        <!-- Columna izquierda (60%) -->
        <div class="hidden sm:flex w-3/5 items-start justify-center pt-32 relative">
            <div class="text-center p-8 text-sonora-blanco">
                <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-6 sm:gap-20">
                    <!-- Imagen izquierda -->
                    <img src="{{ asset('images/sistema/logo-izquierda.svg') }}" alt="Logo Izquierda"
                        class="h-20 sm:h-24 w-auto max-w-full">
                    <!-- Imagen centro -->
                    <img src="{{ asset('images/sistema/logo-centro.png') }}" alt="Logo Centro"
                        class="h-24 sm:h-32 w-auto max-w-full">
                    <!-- Imagen derecha -->
                    <img src="{{ asset('images/sistema/logo-derecha.png') }}" alt="Logo Derecha"
                        class="h-20 sm:h-24 w-auto max-w-full">
                </div>

                <h1 class="mt-6 text-3xl font-bold">
                    Bienvenido a {{ config('app.name', 'Laravel') }}
                </h1>

                <h2 class="mt-4 text-2xl font-semibold">
                    Sistema de Revaluación de Exámenes
                </h2>

                <p class="mt-4 text-sm leading-relaxed">
                    Centro de Gobierno, Edificio Hermosillo 2do. piso. Blvd. Paseo Río Sonora y Comonfort.
                    Col. Villa de Seris. C.P. 83280, Hermosillo, Sonora, México.
                </p>
            </div>

            <!-- Línea divisoria (80% de altura) -->
            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 h-[80%] border-r-2 border-white"></div>
        </div>

        <!-- Columna derecha (40%) con el login -->
        <div class="w-full sm:w-2/5 flex flex-col items-center shadow-lg pt-32">
            <div class="w-full sm:max-w-md px-6 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
