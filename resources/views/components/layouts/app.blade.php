<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @fluxStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        <div class="font-serif bg-tan text-purple h-screen">
            {{ $slot }}
        </div>
        @fluxScripts
    </body>
</html>
