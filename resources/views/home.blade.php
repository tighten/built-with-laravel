<x-public-layout>
    <livewire:orgs-list />

    <div class="mt-36 text-center text-bgrey-500 md:text-2xl" id="about">
        <h2 class="mb-10 text-3xl text-black md:text-5xl">About</h2>

        <div class="mx-auto mb-6 max-w-4xl">
            <p>
                This is a manually curated list of companies and organizations using Laravel, with an emphasis on
                showing <em>real-life</em> projects, not just developer-focused tools and sites. Our goal isn't to get as many sites in
                here as possible; it's to show people who are unsure about Laravel what it can be used for.
            </p>
        </div>

        <div x-data="{ expanded: false }">
            <a
                href="/#"
                class="rounded-2xl border bg-bgrey-040 px-4 py-1 text-base text-black ring-1 ring-transparent transition hover:bg-gray-200 hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                @click.prevent="expanded = !expanded"
            >
                What belongs here?
                <span x-show="!expanded">+</span>
                <span x-show="expanded">-</span>
            </a>

            <ul
                class="mx-auto mb-4 mt-8 max-w-2xl divide-y rounded-lg bg-bgrey-040 text-left text-base text-bgrey-800"
                x-cloak
                x-show="expanded"
            >
                <li class="p-3">
                    Companies and non-profits using Laravel to do or support the work of their organization (whether
                    that's "make profit" or "teach healthcare" or whatever else)
                </li>
                <li class="p-3">No packages or other code</li>
                <li class="p-3">No individual courses or books or other training resources</li>
                <li class="p-3">
                    If it's a developer-focused SaaS, it needs to be large--think Fathom Analytics, not someone's
                    passion side project
                </li>
                <li class="p-3">
                    We have a bias against tools that are
                    <em>only</em>
                    targeted at Laravel developers, because those tools won't add any impact to folks' understanding how
                    Laravel is used in the broader world
                </li>
                <li class="p-3">
                    Agencies are only allowed if they also have products, and are here to show their products
                </li>
                <li class="p-3">
                    Marketing sites for individual developers or agencies aren't allowed as sites examples
                </li>
            </ul>
        </div>
    </div>
</x-public-layout>
