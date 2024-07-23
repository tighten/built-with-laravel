<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @php
            $title = 'Built with Laravel';

            if ($prependTitle) {
                $title = $prependTitle . ' | ' . $title;
            }

            $description = 'A curated list of companies and organizations building with Laravel.';
        @endphp

        <title>{{ $title }}</title>
        <link rel="icon" href="/images/favicon.ico" />

        <meta property="og:title" content="{{ $title }}" />

        <meta property="og:description" content="{{ $description }}" />
        <meta name="description" content="{{ $description }}" />
        <meta property="og:image" content="{{ asset('/images/og.jpg') }}" />
        <meta property="og:url" content="{{ request()->fullUrl() }}" />
        <meta property="og:site_name" content="{{ $title }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if (app()->environment() === 'production')
            <script src="https://cdn.usefathom.com/script.js" data-site="SBSAGNHU" defer></script>
        @endif
    </head>
    <body
        class="bg-cover bg-fixed bg-no-repeat font-sans text-black antialiased"
        style="background-image: url('/images/bwl-background.svg')"
    >
        <div class="relative flex min-h-screen flex-col items-center">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-8xl">
                <header class="pb-10 pt-4" style="view-transition-name: main-heading">
                    @if (in_array(request()->route()->getName(),['organizations.show']))
                        <a href="/" class="absolute left-10 top-10">
                            <img src="/images/arrow-back.svg" loading="lazy" alt="<-" class="inline-block" />
                            Back
                        </a>
                    @endif

                    <a
                        href="/"
                        class="mx-auto mb-5 mt-16 flex w-72 justify-center text-5xl font-bold hover:text-black/70 md:w-auto lg:col-start-2"
                    >
                        <h1>
                            <img
                                src="/images/bwl-logo.svg"
                                fetchpriority="high"
                                alt="Built With Laravel"
                                class="w-144"
                            />
                        </h1>
                    </a>

                    <a
                        href="https://tighten.com/"
                        class="group mx-auto mb-8 block w-48 text-xs font-bold uppercase tracking-wide text-bgrey-400 hover:text-bgrey-500 lg:absolute lg:right-0 lg:top-6"
                    >
                        <span class="mr-2 mt-1">Curated by</span>
                        <img
                            src="/images/tighten-logo.svg"
                            fetchpriority="high"
                            alt="Tighten"
                            width="100"
                            height="22"
                            class="inline-block transition group-hover:scale-110"
                        />
                    </a>

                    <div x-data="{ expanded: false }">
                        <h2 class="mx-auto max-w-xs text-center text-2xl text-bgrey-400 md:max-w-none md:text-3xl">
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
                            @click.away="expanded = false"
                        >
                            {{-- format-ignore-start --}}
                            Any organizations listed here use Laravel <em>somewhere</em>,
                            not necessarily on their primary home page.
                            {{-- format-ignore-end --}}
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
