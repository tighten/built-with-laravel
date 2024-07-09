<x-public-layout>
    <div class="grid-cols-4 gap-10 md:grid">

        <div>
            <div class="rounded-lg bg-black/4 p-4 backdrop-blur-sm">
                <h2 class="mb-5 text-xl font-bold">
                    <img src="{{ $organization->favicon }}" alt="{{ $organization->name }}" class="mr-2 inline-block w-9 rounded-lg" />
                    {{ $organization->name }}
                </h2>
                <p class="mt-2 md:text-lg text-bgrey-500">{{ $organization->description }}</p>
                <hr class="my-4">

                <h3 class="font-bold">How do we know they use Laravel?</h3>
                <p class="text-bgrey-500">{{ $organization->public_source }}</p>

                @if ($organization->technologies->count() > 0)
                    <div class="mt-3 flex gap-2">
                        @foreach ($organization->technologies as $tech)
                            <a
                                href="{{ route('technologies.show', $tech) }}"
                                class="inline-flex items-center rounded bg-white uppercase text-bgrey-500 px-2 text-sm hover:text-gray-700 transition duration-300 hover:bg-gray-200"
                            >
                                {{ $tech->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($organization->sites->count() > 0)
                <div class="my-4">
                    @foreach ($organization->sites as $site)
                        <a href="{{ $site->url }}" class="block rounded-lg bg-black/4 p-4 py-2 backdrop-blur-sm mb-3 text-lg hover:bg-black/13 transition duration-300">
                            {{ $site->name }}
                            <span class="float-right text-xl">&gt;</span>
                        </a>
                    @endforeach
                </div>
            @else
                TODO No sites using Laravel
            @endif


        </div>

        <div class="col-span-3 mt-8 md:mt-0">
            <img src="{{ $organization->image }}" class="rounded-md" />
        </div>
    </div>
</x-public-layout>
