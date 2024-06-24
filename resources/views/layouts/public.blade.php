<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black dark:bg-black dark:text-white">
            <div class="relative min-h-screen flex flex-col items-center">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <a href="/" class="flex lg:justify-center lg:col-start-2 text-5xl font-bold hover:text-black/70 dark:hover:text-white/80">
                            Built with Laravel
                        </a>
                        <livewire:public.navigation />
                    </header>

                <!-- Page Content -->
                <main class="mt-6">
                    {{ $slot }}
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70 border-t mt-24">
                    This is a work-in-progress site made by the fine folks at <a href="https://tighten.com/" class="font-bold hover:underline">Tighten</a>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
