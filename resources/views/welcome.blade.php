<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Built With Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black dark:bg-black dark:text-white">
            <div class="relative min-h-screen flex flex-col items-center  selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2 text-4xl font-bold">
                            Built with Laravel
                        </div>
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-3 lg:gap-8">
                            @foreach ($orgs as $org)
                            <div class="bg-gray-100 hover:bg-gray-200 rounded-lg p-4 group">
                                [img]
                                <h2 class="font-bold">
                                    <a href="{{ $org->url }}">{{ $org->name }}</a>
                                </h2>
                                <p>{{ $org->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Footer here
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
