<x-public-layout>
    <div class="mx-auto max-w-5xl">
        <div class="lg:grid lg:grid-cols-3 gap-10">
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
                        <label class="block">Organization name *</label>
                        <input
                            type="text"
                            class="w-96 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl"
                            name="name"
                            placeholder="Tighten"
                            value="{{ old('name') }}"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label class="block">Organization URL *</label>
                        <input
                            type="url"
                            class="w-96 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl"
                            name="url"
                            placeholder="https://tighten.com/"
                            value="{{ old('url') }}"
                        />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div class="mb-8 md:grid md:grid-cols-2 gap-x-10">
                        <div class="col-span-2">
                            How do you know they use Laravel?
                        </div>

                        <div>
                            <textarea class="h-32 w-128 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl" placeholder="Public" name="public_source">{{ old('public_source') }}</textarea>
                            <label class="block">
                                <span class="text-sm italic text-gray-500">
                                    (if this information
                                    <strong>can</strong>
                                    safely be shared publicly)
                                </span>
                            </label>
                        </div>

                        <div>
                            <textarea class="h-32 w-128 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl" placeholder="Private" name="private_source">{{ old('private_source') }}</textarea>
                            <label class="block">
                                <span class="text-sm italic text-gray-500">
                                    (if this information
                                    <strong>cannot</strong>
                                    safely be shared publicly)
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block">
                            What sites/microsites/apps specifically use Laravel? (new line for each URL)
                        </label>
                        <textarea
                            class="h-32 w-128 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl"
                            name="sites"
                            placeholder="https://fieldgoal.io/">{{ old('sites') }}</textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block">What technologies are they using?</label>
                        <select name="technologies[]" multiple class="h-32 w-64 bg-black/4 backdrop-blur-lg border-none rounded-xl">
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
                        <label class="block">Your name *</label>
                        <input
                            type="text"
                            class="w-96 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl"
                            name="suggester_name"
                            placeholder="Firstname Lastname"
                            value="{{ old('suggester_name') }}"
                        />
                        <x-input-error :messages="$errors->get('suggester_name')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label class="block">Your email *</label>
                        <input
                            type="email"
                            class="w-96 max-w-full bg-black/4 backdrop-blur-lg border-none rounded-xl"
                            name="suggester_email"
                            placeholder="you@awesome.com"
                            value="{{ old('suggester_email') }}"
                        />
                        <x-input-error :messages="$errors->get('suggester_email')" class="mt-2" />
                    </div>

                    <input
                        type="submit"
                        class="block rounded float-right text-white text-sm border-none rounded-lg p-2 px-5 bg-black hover:bg-black/80"
                        value="Submit Suggestion"
                    />
                </form>
            </div>
            <div class="lg:border-l lg:pl-10 clear-both mt-32 lg:mt-0 backdrop-blur-lg">
                <ul
                    class="mx-auto mb-4 divide-y divide-black/4 rounded-lg bg-black/4 text-left text-base text-bgrey-800"
                >
                    <li class="p-3 font-bold bg-black/10 rounded-t-lg">What belongs here?</li>
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
                        targeted at Laravel developers, because those tools won't add any impact to folks' understanding how
                        Laravel is used in the broader world
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
