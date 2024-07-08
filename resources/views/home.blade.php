<x-public-layout>
    <livewire:orgs-list />

    <div class="text-center mt-36 md:text-2xl text-bgrey-500" id="about">
        <h2 class="text-3xl md:text-5xl text-black mb-10">About</h2>

        <div class="max-w-4xl mx-auto mb-6">
            <p>This is a manually curated list of companies and organizations using Laravel, with an emphasis on showing <em>real-life</em> projects (not just a bunch of Laravel-focused developer tools). Our goal isn't to get as many sites in here as possible; it's to show people who are unsure about Laravel what it can be used for.</p>
        </div>

        <div x-data="{ expanded: false }">
            <a
                href="/#"
                class="rounded-2xl border px-4 py-1 text-black text-base ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] bg-bgrey-040 hover:bg-gray-200"
                @click.prevent="expanded = !expanded"
            >
                What belongs here? <span x-show="!expanded">+</span><span x-show="expanded">-</span>
            </a>

            <ul class="divide-y text-left mb-4 max-w-2xl bg-bgrey-040 mx-auto rounded-lg mt-8 text-base text-bgrey-800" x-cloak x-show="expanded">
                <li class="p-3">Companies and non-profits using Laravel to do or support the work of their organization (whether that's "make profit" or "teach healthcare" or whatever else)</li>
                <li class="p-3">No packages or other code</li>
                <li class="p-3">No individual courses or books or other training resources</li>
                <li class="p-3">If it's a developer-focused SaaS, it needs to be large--think Fathom Analytics, not someone's passion side project</li>
                <li class="p-3">We have a bias against tools that are <em>only</em> targeted at Laravel developers, because those tools won't add any impact to folks' understanding how Laravel is used in the broader world</li>
                <li class="p-3">Agencies are only allowed if they also have products, and are here to show their products</li>
                <li class="p-3">Marketing sites for individual developers or agencies aren't allowed as sites examples</li>
            </ul>
        </div>
    </div>
 </x-public-layout>
