<div
    class="group relative flex cursor-pointer flex-col-reverse rounded-lg bg-black/4 p-4 backdrop-blur-lg transition duration-300 hover:bg-black/13 md:p-6 md:pt-5"
>
    <div class="aspect-[600/444] overflow-hidden rounded border border-black/4">
        @if ($org->sites->count() > 0)
            <img
                loading="lazy"
                alt="{{ $org->name }}"
                width="540"
                height="400"
                class="aspect-[600/444] max-w-full rounded-sm transition duration-300 group-hover:scale-115"
                src="{{ Storage::url($org->sites->first()->image) }}"
                style="view-transition-name: main-site-{{ $org->sites->first()->slug }}"
            />
        @else
            <div
                class="bg-white bg-contain transition duration-300 group-hover:scale-115"
                style="
                    background-image: url('/images/siteless-background.png');
                    view-transition-name: no-site-{{ $org->slug }};
                "
            >
                <img
                    loading="lazy"
                    alt="{{ $org->name }}"
                    width="540"
                    height="400"
                    class="aspect-[600/444] max-w-full rounded-sm transition duration-300 group-hover:scale-115"
                    src="{{ Storage::url($org->image) }}"
                />
            </div>
        @endif
    </div>

    {{-- This is at the bottom because the image wouldn't be clickable otherwise (this is flipped via flexbox)... --}}
    <h2 class="mb-5 text-xl font-bold" style="view-transition-name: organization-{{ $org->slug }}">
        <img
            loading="lazy"
            src="{{ Storage::url($org->favicon) }}"
            alt="{{ $org->name }}"
            class="mr-2 inline-block w-9 rounded-lg"
        />
        <a href="{{ route('organizations.show', $org) }}">
            {{ $org->name }}
            <span class="absolute inset-0 z-10"></span>
        </a>
    </h2>
</div>
