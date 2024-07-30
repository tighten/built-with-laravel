<div>
    <div class="mb-2 md:mb-10">
        <div
            x-data="{ filterTechnology: @js($filterTechnology) }"
            x-init="
                filterTechnology !== null &&
                    document
                        .getElementById(`tech-filter--${filterTechnology}`)
                        .scrollIntoView(false)
            "
            class="flex overflow-x-scroll pb-1 font-mono text-sm font-bold uppercase scrollbar:!h-1.5 scrollbar:!w-1.5 scrollbar:bg-transparent scrollbar-track:!rounded scrollbar-track:!bg-bgrey-100/50 scrollbar-thumb:!rounded scrollbar-thumb:!bg-bgrey-200 sm:flex-wrap sm:justify-center sm:overflow-x-hidden sm:pb-0 md:text-base"
        >
            <a
                href="/"
                class="{{ $filterTechnology == null ? 'border-tighten-yellow text-black hover:border-tighten-yellow' : 'text-gray-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
            >
                All
                <span class="hidden md:inline-block">Technologies</span>
            </a>
            @foreach ($technologies as $tech)
                <a
                    href="{{ route('home', ['technology' => $tech->slug]) }}"
                    class="{{ $filterTechnology == $tech->slug ? 'border-tighten-yellow hover:border-tighten-yellow text-black ' : 'text-bgrey-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
                    id="tech-filter--{{ $tech->slug }}"
                >
                    {{ $tech->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
