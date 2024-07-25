<x-public-layout :prependTitle="$organization->name">
    <div class="grid-cols-3 gap-10 lg:grid xl:grid-cols-4" x-data="orgshow" x-init="parseHash">
        <div>
            <div class="rounded-xl bg-black/4 p-4 backdrop-blur-lg">
                <a href="{{ $organization->url }}">
                    <h2
                        class="mb-3 text-xl font-bold"
                        style="view-transition-name: organization-{{ $organization->slug }}"
                    >
                        <img
                            loading="lazy"
                            src="{{ $organization->favicon }}"
                            alt="{{ $organization->name }}"
                            class="mr-2 inline-block w-9 rounded-lg"
                        />
                        {{ $organization->name }}
                    </h2>
                </a>
                <p class="text-bgrey-500 md:text-lg">{{ $organization->description }}</p>
                <hr class="my-3 border-black/4" />

                <h3 class="text-sm font-bold">How do we know they use Laravel?</h3>
                <p class="text-sm text-bgrey-500">{{ $organization->public_source }}</p>

                @if ($organization->technologies->count() > 0)
                    <div class="mt-3 flex gap-2 font-mono">
                        @foreach ($organization->technologies as $tech)
                            <a
                                href="{{ route('home', ['technology' => $tech]) }}"
                                class="inline-flex items-center rounded bg-white px-2 text-sm font-bold uppercase text-bgrey-400 transition duration-300 hover:bg-gray-200 hover:text-gray-700"
                            >
                                {{ $tech->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="my-4">
                @if ($organization->sites->count() > 0)
                    <div class="mb-2 text-black/60">Projects using Laravel:</div>

                    <div class="hidden md:block">
                        @foreach ($organization->sites as $site)
                            <a
                                href="#site-{{ $site->slug }}"
                                class="mb-3 block rounded-xl bg-black/4 p-4 py-2 text-lg backdrop-blur-lg transition duration-300 hover:bg-black/13"
                                @click="selected = '{{ $site->slug }}'"
                            >
                                {{ $site->name }}
                                <span class="float-right mt-1"><img src="/images/chevron-forward.svg" alt=">" /></span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="p-2 text-bgrey-500">
                        While this organization is known to use Laravel, we don't currently have links to any
                        publicly-accessible sites or apps known to be using Laravel.
                    </div>
                @endif
            </div>
        </div>

        <div class="col-span-2 mt-8 md:mt-0 xl:col-span-3">
            @if ($organization->sites->count() === 0)
                <a
                    href="{{ $organization->url }}"
                    class="group relative block bg-white bg-contain transition duration-300 group-hover:scale-115"
                    style="
                        background-image: url('/images/siteless-background.png');
                        view-transition-name: no-site-{{ $organization->slug }};
                    "
                >
                    <span
                        target="_blank"
                        class="w-38 pointer-events-none absolute right-4 top-4 rounded-xl border bg-white px-4 shadow group-hover:bg-bgrey-100"
                    >
                        Visit website
                        <img
                            loading="lazy"
                            src="/images/open-in-new.svg"
                            alt="Open in new"
                            class="ml-2 inline-block align-text-bottom"
                        />
                    </span>
                    <img loading="lazy" src="{{ $organization->image }}" class="rounded-md border" />
                </a>
            @else
                @foreach ($organization->sites as $site)
                    <div
                        id="site-{{ $site->slug }}"
                        class="mb-10"
                        style="view-transition-name: main-site-{{ $site->slug }}"
                    >
                        <div
                            class="font-bold"
                            :class="selected == '{{ $site->slug }}' ? 'text-black' : 'text-bgrey-500'"
                        >
                            {{ $site->name }}
                        </div>
                        <div class="group relative">
                            <span
                                target="_blank"
                                class="w-38 pointer-events-none absolute right-4 top-4 rounded-xl border bg-white px-4 shadow group-hover:bg-bgrey-100"
                            >
                                Visit website
                                <img
                                    loading="lazy"
                                    src="/images/open-in-new.svg"
                                    alt="Open in new"
                                    class="ml-2 inline-block align-text-bottom"
                                />
                            </span>
                            <a href="{{ $site->url }}" target="_blank">
                                <img
                                    loading="lazy"
                                    src="{{ $site->image }}"
                                    class="rounded-md border"
                                    :class="selected == '{{ $site->slug }}' && 'border border-2 border-black/20'"
                                />
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('orgshow', () => ({
                selected: null,

                parseHash() {
                    let hash = window.location.hash;

                    if (hash.includes('#site-')) {
                        this.selected = hash.substring(6);
                    }
                },
            }));
        });
    </script>
</x-public-layout>
