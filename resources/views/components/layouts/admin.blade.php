<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Administrador</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="//unpkg.com/alpinejs"></script>
</head>

<body class="antialiased bg-gray-100">
    <x-admin.nav>
        {{ $slot }}
    </x-admin.nav>
</body>

</html>
