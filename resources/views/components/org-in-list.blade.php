<div
    x-data="{ link: '{{ route('organizations.show', ['organization' => $org->slug]) }}' }"
    x-on:click="window.location = link"
    onClick="window.location = this.getAttribute('link')"
    wire:key="org-{{ $org->id }}"
    class="relative group bg-black/4 backdrop-blur-sm rounded-lg p-6 pt-5 cursor-pointer hover:bg-black/13 transition duration-300">
    <h2 class="font-bold text-xl mb-5">
        <img src="{{ $org->favicon }}" alt="{{ $org->name }}" class="rounded-lg w-9 inline-block mr-2">
        {{ $org->name }} <a href="{{ $org->url }}">@include('icons.link')</a>
    </h2>
    <div class="aspect-[600/444] rounded overflow-hidden relative border border-black/4">
        <div class="w-full h-full absolute z-50 bottom-0"></div>
        <img alt="" width="540" height="400" class="rounded-sm aspect-[600/444] max-w-full group-hover:scale-115 transition duration-300 drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)]" src="{{ $org->image }}">
    </div>
</div>
