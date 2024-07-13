<x-public-layout>
    <x-orgs-list
        :organizations="$organizations"
        :technologies="$technologies"
        :filterTechnology="$filterTechnology"
    ></x-orgs-list>

    <div class="mt-24 text-center text-bgrey-500 md:text-2xl" id="about">
        <h2 class="mb-6 text-2xl font-bold uppercase text-black md:text-4xl">About</h2>

        <div class="mx-auto mb-8 max-w-4xl">
            <p>
                This is a manually curated list of companies and organizations using Laravel, with an emphasis on
                showing
                <em>real-life</em>
                projects, not just developer-focused tools and sites. Our goal isn't to get as many sites in here as
                possible; it's to show people who are unsure about Laravel what it can be used for.
            </p>
        </div>
    </div>
</x-public-layout>
