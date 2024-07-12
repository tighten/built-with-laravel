<div
    x-data="{
        link: '{{ route('organizations.show', ['organization' => $org->slug]) }}',
    }"
    x-on:click="window.location = link"
    onClick="window.location = this.getAttribute('link')"
    wire:key="org-{{ $org->id }}"
    class="group relative cursor-pointer rounded-lg bg-black/4 p-4 backdrop-blur-lg transition duration-300 hover:bg-black/13 md:p-6 md:pt-5"
>
    <h2 class="mb-5 text-xl font-bold">
        <img src="{{ $org->favicon }}" alt="{{ $org->name }}" class="mr-2 inline-block w-9 rounded-lg" />
        {{ $org->name }}
    </h2>
    <div class="relative aspect-[600/444] overflow-hidden rounded border border-black/4">
        <div class="absolute bottom-0 z-50 h-full w-full"></div>

        @if ($org->sites->count() > 0)
            <img
                loading="lazy"
                alt="{{ $org->name }}"
                width="540"
                height="400"
                class="aspect-[600/444] max-w-full rounded-sm drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)] transition duration-300 group-hover:scale-115"
                src="{{ $org->sites->first()->image }}"
            />
        @else
            <div class="bg-white bg-contain transition duration-300 group-hover:scale-115" style="background-image: url('/images/siteless-background.png')">
                <img
                    loading="lazy"
                    alt="{{ $org->name }}"
                    width="540"
                    height="400"
                    class="aspect-[600/444] max-w-full rounded-sm transition duration-300 group-hover:scale-115"
                    src="{{ $org->image }}"
                />
            </div>
        @endif

    </div>
</div>
