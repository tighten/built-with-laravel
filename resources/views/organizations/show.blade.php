<x-public-layout>
    <div class="md:grid grid-cols-3 gap-2">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold">{{ $organization->name }} <a href="{{ $organization->url }}">@include('icons.link')</a></h2>
            <p class="md:text-lg mb-10 mt-2">{{ $organization->description }}</p>

            @if ($organization->sites->count() > 0)
            <div class="my-4">
                <span class="font-bold uppercase">Sites using Laravel</span>
                <ul class="list-disc pl-4">
                    @foreach ($organization->sites as $site)
                    <li><a href="{{ $site->url }}" class="hover:underline">{{ $site->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h3 class="font-bold">How do we know they use Laravel?</h3>
            <p>{{ $organization->public_source }}</p>

            @if ($organization->technologies->count() > 0)
            <div class="mt-6">
            @foreach ($organization->technologies as $tech)
                <a href="{{ route('technologies.show', $tech )}}" class="inline-flex items-center px-2 py-1 rounded bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 text-sm border dark:border-gray-800 hover:border-gray-400 dark:hover:border-gray-600">{{ $tech->name }}</a>
            @endforeach
            </div>
            @endif
        </div>
        <div class="col-span-2 mt-8 md:mt-0">
            <img src="{{ $organization->image }}" class="rounded-md border border-4 border-gray-200 dark:border-gray-800">
        </div>
    </div>
</x-public-layout>
