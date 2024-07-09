<div>
    <div class="mb-10">
        <div class="flex flex-wrap justify-center text-sm font-bold uppercase md:text-base">
            <a
                href="/"
                class="{{ $filterTechnology == null ? 'border-tighten-yellow text-black hover:border-tighten-yellow' : 'text-gray-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 px-3 py-1 active:border-tighten-yellow active:text-tighten-yellow"
            >
                All Technologies
            </a>
            @foreach ($this->technologies as $tech)
                <a
                    href="{{ route('technologies.show', $tech->slug) }}"
                    class="{{ $filterTechnology == $tech->slug ? 'border-tighten-yellow hover:border-tighten-yellow text-black ' : 'text-bgrey-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 px-3 py-1 active:border-tighten-yellow active:text-tighten-yellow"
                >
                    {{ $tech->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
