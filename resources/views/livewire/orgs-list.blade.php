<div>
    <div class="mb-2 md:mb-10">
        <div class="flex flex-wrap justify-center font-mono text-sm font-bold uppercase md:text-base">
            <a
                href="/"
                class="{{ $technology == null ? 'border-tighten-yellow text-black hover:border-tighten-yellow' : 'text-gray-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
                wire:key="all"
                wire:click.prevent="$set('technology', '')"
            >
                All
                <span class="hidden md:inline-block">Technologies</span>
            </a>
            @foreach ($this->technologies as $tech)
                <a
                    class="{{ $technology == $tech->slug ? 'border-tighten-yellow hover:border-tighten-yellow text-black ' : 'text-bgrey-400 hover:text-gray-600 hover:border-gray-400 ' }} border-b-2 border-black/10 px-3 py-1 transition duration-300 active:border-tighten-yellow active:text-tighten-yellow"
                    href="{{ route('home', ['technology' => $tech->slug]) }}"
                    wire:key="{{ $tech->id }}"
                    wire:click.prevent="$set('technology', '{{ $tech->slug }}')"
                >
                    {{ $tech->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="relative grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8" x-auto-animate.175ms>
        @foreach ($this->organizations as $org)
            <x-org-in-list wire:key="{{ $org->id }}" :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
