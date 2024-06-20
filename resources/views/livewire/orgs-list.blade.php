<div>
    <div class="mb-4">
        Technologies:<br>

        @foreach ($this->technologies as $tech)
            <label class="mr-2"><input type="checkbox" value="{{ $tech->slug }}" wire:model.live="filterTechnologies"> {{ $tech->name }}</label>
        @endforeach
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
        <div wire:key="org-{{ $org->id }}" class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4">
            <div class="mb-2 aspect-[600/444] bg-black/25 rounded-md">
                <img alt="" width="540" height="400" class="aspect-[600/444] max-w-full" src="/images/sample.png" /*src="{{ $org->image }}"*/>
            </div>
            <h2 class="font-bold text-lg">
                <a href="{{ $org->url }}">{{ $org->name }}</a>
            </h2>
            <p class="opacity-70">{{ $org->description }}</p>

            @if ($org->sites->count() > 0)
                <div class="my-4">
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
                <span class="inline-flex items-center px-2 py-1 rounded bg-white/10 text-sm">{{ $tech->name }}</span>
            @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
