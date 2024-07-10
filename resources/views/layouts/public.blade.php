<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="bg-cover bg-fixed bg-no-repeat font-sans text-black antialiased"
        style="background-image: url('/images/bwl-background.svg')"
    >
        <div class="relative flex min-h-screen flex-col items-center">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-8xl">
                <header class="pb-10 pt-4">
                    <a
                        href="https://tighten.com/"
                        class="group mb-12 flex flex-1 justify-center text-xs font-bold uppercase tracking-wide text-bgrey-400 hover:text-bgrey-500 md:justify-end"
                    >
                        <span class="mr-2 mt-1">Curated by</span>
                        <img
                            src="/images/tighten-logo.svg"
                            alt="Tighten"
                            width="100"
                            height="22"
                            class="transition group-hover:scale-110"
                        />
                    </a>
                    <a
                        href="/"
                        class="mb-5 mt-8 flex justify-center text-5xl font-bold hover:text-black/70 lg:col-start-2"
                    >
                        <h1><img src="/images/bwl-logo.svg" alt="Built With Laravel" class="w-144" /></h1>
                    </a>
                    <div x-data="{ expanded: false }">
                        <h2 class="text-center text-xl text-bgrey-400 md:text-3xl">
                            A curated catalog of organizations using Laravel
                            <a
                                href="#"
                                class="text-tighten-yellow hover:text-black"
                                @click.prevent="expanded = !expanded"
                                x-ref="asterisk"
                            >
                                *
                            </a>
                        </h2>

                        <div
                            class="absolute right-0 w-64 rounded border bg-white p-3 text-sm shadow"
                            x-cloak
                            x-show="expanded"
                            x-anchor.bottom-start="$refs.asterisk"
                        >
                            Any organizations listed here use Laravel
                            <em>somewhere</em>
                            , not necessarily on their primary home page.
                        </div>
                    </div>

                    <livewire:public.navigation />
                </header>

                <!-- Page Content -->
                <main class="mt-6">
                    {{ $slot }}
                </main>

                <footer class="mb-8 mt-36 text-center text-sm text-gray-500">
                    Made by the fine folks at
                    <a href="https://tighten.com/" class="font-bold hover:underline">Tighten</a>
                </footer>
            </div>
        </div>
    </body>
</html>
