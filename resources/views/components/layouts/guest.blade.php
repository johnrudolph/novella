<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @fluxStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 max-w-lg mx-auto">
        <flux:main>
            {{ $slot }}
        </flux:main>
        @fluxScripts
    </body>
</html>
