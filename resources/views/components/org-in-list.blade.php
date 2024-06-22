<div wire:key="org-{{ $org->id }}" class="relative bg-gray-100 dark:bg-gray-900 border rounded-lg p-4">
    <div class="mb-4 aspect-[600/444] bg-black/25 rounded-sm">
        <img alt="" width="540" height="400" class="rounded-sm aspect-[600/444] max-w-full" src="/images/sample.png" /*src="{{ $org->image }}"*/>
    </div>
    <h2 class="font-bold text-lg">
        <a href="{{ $org->url }}">{{ $org->name }}</a>
    </h2>
    <p class="opacity-70">{{ $org->description }}</p>

    @if ($org->sites->count() > 0)
        <div class="my-4 text-gray-700 dark:text-gray-300">
            <span class="text-sm font-bold uppercase">Sites using Laravel</span>
            <ul class="list-disc pl-4">
                @foreach ($org->sites as $site)
                <li><a href="{{ $site->url }}" class="hover:underline">{{ $site->name }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-2">
    @foreach ($org->technologies as $tech)
        <span class="inline-flex items-center px-2 py-1 rounded bg-black/10 dark:bg-white/10 text-sm">{{ $tech->name }}</span>
    @endforeach
    </div>

    {{--Todo: use x-anchor probably? to get a popover with the explanation of why it's included. --}}
    {{--
    <div x-data="{ expanded: false }">
        <a href="#" x-on:click.prevent="expanded = true" class="bottom-4 right-4 absolute rounded-full bg-white/10 hover:bg-white/30 px-2">?</a>
    </div>
    --}}
</div>
