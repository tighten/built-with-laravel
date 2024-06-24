<div
    x-data="{ link: '{{ route('organizations.show', ['organization' => $org->slug]) }}' }"
    x-on:click="window.location = link"
    onClick="window.location = this.getAttribute('link')"
    wire:key="org-{{ $org->id }}" class="relative bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 border rounded-lg p-4 hover:shadow cursor-pointer border-gray-300 dark:border-gray-700 {{ is_null($org->featured_at) ? '' : 'border-t-4 border-t-teal-500' }}">
    <div class="mb-4 aspect-[600/444] bg-black/25 rounded-sm">
        <img alt="" width="540" height="400" class="rounded-sm aspect-[600/444] max-w-full" src="{{ $org->image }}">
    </div>
    <h2 class="font-bold text-xl">
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

    @if ($org->technologies->count() > 0)
    <div class="mt-2">
    @foreach ($org->technologies as $tech)
        <a href="{{ route('technologies.show', $tech )}}" class="inline-flex items-center px-2 py-1 rounded bg-black/10 dark:bg-white/10 text-sm border hover:border-gray-400">{{ $tech->name }}</a>
    @endforeach
    </div>
    @endif

    <div x-data="{ expanded: false }">
        <a href="#" x-ref="question" x-on:click.stop.prevent="expanded = true" class="bottom-4 right-4 absolute rounded-full dark:hover:text-gray-400 bg-gray-200 hover:bg-white/10 dark:bg-gray-800 hover:dark:bg-white/30 border dark:border-gray-700 hover:border-gray-400 px-2 text-gray-500">?</a>
        <div x-show="expanded" @click.stop="expanded = false" @click.outside="expanded = false" x-anchor.top.offset.10="$refs.question" x-cloak class="bg-white dark:bg-black w-40 p-3 text-sm border border-gray-300 dark:border-gray-700 shadow rounded z-50"><div class="font-bold">How do we know?</div> {{ $org->public_source }}</div>
    </div>
</div>
