<div
    x-data="{ link: '{{ route('organizations.show', ['organization' => $org->slug]) }}' }"
    x-on:click="window.location = link"
    onClick="window.location = this.getAttribute('link')"
    wire:key="org-{{ $org->id }}"
    class="relative group bg-gray-300/20 backdrop-blur rounded-lg p-4 px-6 cursor-pointer shadow-card hover:shadow-card-blurred hover:bg-gray-100/30 transition">
    <h2 class="font-bold text-xl mb-4">
        <img src="{{ $org->favicon }}" alt="{{ $org->name }}" class="rounded-lg w-8 inline-block mr-2">
        {{ $org->name }} <a href="{{ $org->url }}">@include('icons.link')</a>
    </h2>
    <div class="mb-4 aspect-[600/444] rounded overflow-hidden shadow-inner">
        <img alt="" width="540" height="400" class="rounded-sm aspect-[600/444] max-w-full group-hover:scale-125 transition" src="{{ $org->image }}">
    </div>
</div>
