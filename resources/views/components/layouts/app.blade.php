@php
    $user = Illuminate\Support\Facades\Auth::user();
    $guilds = $user->guilds;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @fluxStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 max-w-7xl">
        <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Novella" class="px-2 dark:hidden" />
            <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Novella" class="px-2 hidden dark:flex" />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="home" href="{{ route('dashboard') }}">Home</flux:navlist.item>
                <flux:navlist.group expandable heading="Guilds" class="hidden lg:grid">
                    @foreach($guilds as $guild)
                        <flux:navlist.item href="{{ route('guild.show', $guild) }}">{{ $guild->name }}</flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />


            <flux:navlist variant="outline">
                <flux:menu.item icon="user-circle">{{ $user->name }}</flux:menu.item>
                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:navlist>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        </flux:header>

        <flux:main>
            {{ $slot }}
        </flux:main>
            @fluxScripts
    </body>
</html>
