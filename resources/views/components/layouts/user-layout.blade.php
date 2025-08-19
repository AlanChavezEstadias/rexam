<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Usuario</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="//unpkg.com/alpinejs"></script>
</head>

<body class="min-h-screen bg-gray-100">
    <x-user.nav>
        {{ $slot }}
    </x-user.nav>
</body>

</html>
