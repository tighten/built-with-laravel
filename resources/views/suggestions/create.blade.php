<x-public-layout prependTitle="Suggest an Organization">
    <div class="mx-auto max-w-8xl">
        <div class="gap-10 lg:grid lg:grid-cols-3">
            <div class="col-span-2 text-lg">
                <h2 class="mb-10 text-3xl">Suggest an organization</h2>

                @if (Session::has('flash'))
                    <div class="mb-4 max-w-5xl border border-blue-400 bg-blue-100 px-4 py-2 text-blue-900">
                        {{ Session::get('flash') }}
                    </div>
                @endif

                <form method="post" action="{{ route('suggestions.store') }}">
                    @csrf
                    <div class="mb-8">
                        <label class="mb-1 block">Organization name *</label>
                        <input
                            type="text"
                            class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg"
                            name="name"
                            placeholder="Tighten"
                            value="{{ old('name') }}"
                            required
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label class="mb-1 block">Organization URL *</label>
                        <input
                            type="url"
                            class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg"
                            name="url"
                            placeholder="https://tighten.com/"
                            value="{{ old('url') }}"
                            required
                        />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div class="mb-8 gap-x-10 md:grid md:grid-cols-2">
                        <div class="col-span-2">How do you know they use Laravel?</div>

                        <div class="mb-6 md:mb-0">
                            <textarea
                                class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 text-lg backdrop-blur-lg"
                                placeholder="Public"
                                name="public_source"
                            >
{{ old('public_source') }}</textarea
                            >
                            <label class="-mt-2 block">
                                <span class="text-sm italic text-gray-500">
                                    (if this information
                                    <strong>can</strong>
                                    safely be shared publicly)
                                </span>
                            </label>
                        </div>

                        <div>
                            <div class="relative">
                                <img src="/images/lock.svg" alt="Lock" class="absolute right-3 top-3 z-50" />
                                <textarea
                                    class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 text-lg backdrop-blur-lg"
                                    placeholder="Private"
                                    name="private_source"
                                >
{{ old('private_source') }}</textarea
                                >
                            </div>
                            <label class="-mt-2 block">
                                <span class="text-sm italic text-gray-500">
                                    (if this information
                                    <strong>cannot</strong>
                                    safely be shared publicly)
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="mb-1 block">
                            What sites/microsites/apps specifically use Laravel? (new line for each URL)
                        </label>
                        <textarea
                            class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg"
                            name="sites"
                            autocorrect="off"
                            autocapitalize="none"
                            placeholder="https://fieldgoal.io/"
                        >
{{ old('sites') }}</textarea
                        >
                    </div>

                    <div class="mb-8">
                        <label class="mb-1 block">What technologies are they using?</label>
                        <select
                            name="technologies[]"
                            multiple
                            class="w-64 rounded-xl border-none bg-black/4 backdrop-blur-lg md:h-32"
                        >
                            @foreach ($technologies as $technology)
                                <option
                                    value="{{ $technology->slug }}"
                                    {{ collect(old('technologies'))->contains($technology->slug) ? 'selected' : '' }}
                                >
                                    {{ $technology->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="mb-1 block">Your name *</label>
                        <input
                            type="text"
                            class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg"
                            name="suggester_name"
                            placeholder="Firstname Lastname"
                            value="{{ old('suggester_name') }}"
                            required
                        />
                        <x-input-error :messages="$errors->get('suggester_name')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label class="mb-1 block">Your email *</label>
                        <input
                            type="email"
                            class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg"
                            name="suggester_email"
                            placeholder="you@awesome.com"
                            value="{{ old('suggester_email') }}"
                            required
                        />
                        <x-input-error :messages="$errors->get('suggester_email')" class="mt-2" />
                    </div>

                    <input
                        type="submit"
                        class="float-right block rounded rounded-lg border-none bg-black p-2 px-5 text-sm text-white hover:bg-black/80"
                        value="Submit Suggestion"
                    />
                </form>
            </div>
            <div class="clear-both mt-32 backdrop-blur-lg lg:mt-0 lg:border-l lg:pl-10">
                <ul
                    class="mx-auto mb-4 divide-y divide-black/4 rounded-lg bg-black/4 text-left text-base text-bgrey-800"
                >
                    <li class="rounded-t-lg bg-black/10 p-3 font-bold">What belongs here?</li>
                    <li class="p-3">
                        Companies and non-profits using Laravel to do or support the work of their organization (whether
                        that's "make profit" or "teach healthcare" or whatever else)
                    </li>
                    <li class="p-3">No packages or other code</li>
                    <li class="p-3">No individual courses or books or other training resources</li>
                    <li class="p-3">
                        If it's a developer-focused SaaS, it needs to be large--think Fathom Analytics, not someone's
                        passion side project
                    </li>
                    <li class="p-3">
                        We have a bias against tools that are
                        <em>only</em>
                        targeted at Laravel developers, because those tools won't add any impact to folks' understanding
                        how Laravel is used in the broader world
                    </li>
                    <li class="p-3">
                        Agencies are only allowed if they also have products, and are here to show their products
                    </li>
                    <li class="p-3">
                        Marketing sites for individual developers or agencies aren't allowed as sites examples
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-public-layout>
