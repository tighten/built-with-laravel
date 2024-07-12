<div
    wire:key="org-{{ $org->id }}"
    class="group relative cursor-pointer rounded-lg bg-black/4 p-4 backdrop-blur-lg transition duration-300 hover:bg-black/13 md:p-6 md:pt-5"
>
    <h2 class="mb-5 text-xl font-bold">
        <img src="{{ $org->favicon }}" alt="{{ $org->name }}" class="mr-2 inline-block w-9 rounded-lg" />
        <a wire:navigate href="{{ route('organizations.show', ['organization' => $org->slug]) }}">{{ $org->name }}<span class="absolute inset-0 z-10"></span></a>
    </h2>
    <div class="aspect-[600/444] overflow-hidden rounded border border-black/4">
        <img
            loading="lazy"
            alt="{{ $org->name }}"
            width="540"
            height="400"
            class="aspect-[600/444] max-w-full rounded-sm drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)] transition duration-300 group-hover:scale-115"
            src="{{ $org->sites->count() > 0 ? $org->sites->first()->image : $org->image }}"
        />
    </div>
</div>
