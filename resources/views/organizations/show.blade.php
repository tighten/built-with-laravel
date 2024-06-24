<x-public-layout>
    <div class="grid grid-cols-3 gap-2">
        <div>
            <h2 class="text-4xl font-bold">{{ $organization->name }}</h2>
            <p>{{ $organization->description }}</p>

            @if ($organization->sites->count() > 0)
            <div class="my-4 text-gray-700 dark:text-gray-300">
                <span class="text-sm font-bold uppercase">Sites using Laravel</span>
                <ul class="list-disc pl-4">
                    @foreach ($organization->sites as $site)
                    <li><a href="{{ $site->url }}" class="hover:underline">{{ $site->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if ($organization->technologies->count() > 0)
            <div class="mt-2">
            @foreach ($organization->technologies as $tech)
                <a href="{{ route('technologies.show', $tech )}}" class="inline-flex items-center px-2 py-1 rounded bg-black/10 dark:bg-white/10 text-sm border hover:border-gray-400">{{ $tech->name }}</a>
            @endforeach
            </div>
            @endif
        </div>
        <div class="col-span-2">
            <img src="{{ $organization->image }}" class="rounded-md border border-4 border-gray-200">
        </div>
    </div>
</x-public-layout>
