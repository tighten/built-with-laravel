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
            <div class="relative min-h-screen flex flex-col items-center">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2 text-5xl font-bold">
                            Built with Laravel (WIP)
                        </div>
                        @if (Route::has('login'))
                            {{--<livewire:welcome.navigation />--}}
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="mb-12 p-4 border rounded max-w-5xl mx-auto">
                            <p class="text-lg mb-4">This is a community-maintained list of companies and organizations using Laravel, with an emphasis on showing <em>real-life</em> projects (not just a bunch of Laravel-focused developer tools).</p>
                            <p>What belongs here?</p>
                            <ul class="list-disc pl-6 mb-4">
                                <li>No packages or other code</li>
                                <li>No individual courses or books or other training resources</li>
                                <li>If it's a developer-focused SaaS, it needs to be large--think Fathom Analytics, not someone's passion side project</li>
                                <li>We have a bias against tools that are <em>only</em> targeted at Laravel developers, because those tools won't add any impact to folks' understanding how Laravel is used in the broader world</li>
                                <li>Agencies are only allowed if they also have products, and are here to show their products</li>
                                <li>Marketing sites for individual developers or agencies aren't allowed as sites examples</li>
                            </ul>
                            <p class="dark:text-gray-300 text-gray-600">This site is under active development as of June 2024. What you're seeing right now is not the real site, it's just a staging version of what's to come as we figure out the architecture and scope.</p>
                        </div>

                        <livewire:orgs-list />
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        WIP made by the fine folks at <a href="https://tighten.com/" class="font-bold hover:underline">Tighten</a>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
