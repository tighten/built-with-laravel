<div>
    <div class="mb-2 md:mb-10">
        <div class="flex flex-wrap justify-center font-mono text-sm font-bold uppercase md:text-base">
            <a
                href="/"
                class="{{ $technology == null ? 'border-tighten-yellow text-black hover:border-tighten-yellow' : 'text-gray-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
            >
                All
                <span class="hidden md:inline-block">Technologies</span>
            </a>
            @foreach ($this->technologies as $tech)
                <a
                    wire:navigate
                    href="{{ route('home', ['technology' => $tech->slug]) }}"
                    class="{{ $technology == $tech->slug ? 'border-tighten-yellow hover:border-tighten-yellow text-black ' : 'text-bgrey-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
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
