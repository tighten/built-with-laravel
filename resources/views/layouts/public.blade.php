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
    <body class="antialiased font-sans text-black bg-contain bg-no-repeat bg-fixed" style="background-image: url('/images/temp-blueprint-bg.jpg')"">
        <div class="relative min-h-screen flex flex-col items-center">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="py-10">
                    <div class="mb-8 flex flex-1 justify-center md:justify-end uppercase text-gray-400">Curated by&nbsp;&nbsp; <a href="https://tighten.com/" class="transition hover:scale-110"><img src="/images/tighten-logo.svg" alt="Tighten" width="100" height="22"></a></div>
                    <a href="/" class="flex justify-center lg:col-start-2 text-5xl font-bold hover:text-black/70 mb-4 clear-both">
                        <h1>Built with Laravel</h1>
                    </a>
                    <h2 class="text-center text-3xl text-gray-500">A curated catalog of organizations using Laravel.</h2>

                    <livewire:public.navigation />
                </header>


            <!-- Page Content -->
            <main class="mt-6">
                {{ $slot }}
            </main>

            <footer class="py-16 text-center text-sm text-black border-t mt-24">
                This is a work-in-progress site made by the fine folks at <a href="https://tighten.com/" class="font-bold hover:underline">Tighten</a>
            </footer>
        </div>
    </body>
</html>
