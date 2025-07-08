<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-g">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Admin Panel' }}</title>

        <script src="https://cdn.tailwindcss.com"></script>

        @livewireStyles
    </head>
    <body class="bg-gray-100">

        {{ $slot }}

        @livewireScripts
    </body>
</html>