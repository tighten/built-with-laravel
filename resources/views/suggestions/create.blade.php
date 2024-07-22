<x-public-layout prependTitle="Suggest an Organization">
    <div class="mx-auto max-w-8xl">
        <div class="gap-10 lg:grid lg:grid-cols-3">
            <div class="col-span-2 text-lg">
                <h2 class="mb-8 text-3xl">Suggest an organization</h2>

                @if (Session::has('flash'))
                    <div class="mb-4 max-w-5xl border border-blue-400 bg-blue-100 px-4 py-2 text-blue-900">
                        {{ Session::get('flash') }}
                    </div>
                @endif

                <form method="post" action="{{ route('suggestions.store') }}">
                    @csrf
                    <div>
                        <label id="organization-heading" for="name" class="mb-1 block">Tell us about the Organization</label>

                        <div class="mb-2 relative group">
                            <label for="name" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Organization name *</label>

                            <input
                                type="text"
                                class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg my-1 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                name="name"
                                placeholder="Organization name *"
                                id="name"
                                aria-labelledby="organization-heading name"
                                value="{{ old('name') }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-2 relative group">
                            <label for="url" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Organization URL *</label>

                            <input
                                type="url"
                                class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg my-1 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                name="url"
                                id="url"
                                placeholder="https://tighten.com/"
                                value="{{ old('url') }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-6 gap-x-10 md:grid md:grid-cols-2">
                        <label id="sources-heading" for="public_source" class="col-span-2">How do you know they use Laravel?</label>

                        <div class="mb-4 md:mb-0 relative group">
                            <label for="public_source" id="sources-label-public" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Public</label>

                            <textarea
                                class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg mt-2 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                placeholder="Public"
                                name="public_source"
                                id="public_source"
                                aria-labelledby="sources-heading sources-help-public"
                            >{{ old('public_source') }}</textarea>

                            <span id="sources-help-public" class="block text-sm italic text-gray-500">
                                (if this information
                                <strong>can</strong>
                                safely be shared publicly)
                            </span>
                        </div>

                        <div class="relative group">
                            <label for="private_source" id="sources-label-private" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Private</label>

                            <img aria-hidden="true" src="/images/lock.svg" alt="Lock" class="absolute right-3 top-3 z-50" />

                            <textarea
                                class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg mt-2 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                placeholder="Private"
                                name="private_source"
                                id="private_source"
                                aria-labelledby="sources-heading sources-help-private"
                            >{{ old('private_source') }}</textarea>

                            <span id="sources-help-private" class="block text-sm italic text-gray-500">
                                (if this information
                                <strong>cannot</strong>
                                safely be shared publicly)
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="sites" class="mb-1 block">
                            What sites/microsites/apps specifically use Laravel? (new line for each URL)
                        </label>

                        <div class="relative group">
                            <label for="sites" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Sites</label>

                            <textarea
                                class="h-32 w-128 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg my-2 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                id="sites"
                                name="sites"
                                autocorrect="off"
                                autocapitalize="none"
                                placeholder="https://fieldgoal.io/"
                            >{{ old('sites') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label id="technologies-heading" class="mb-1 block">What technologies are they using?</label>

                        <div class="flex flex-wrap gap-2 leading-none">
                            @foreach ($technologies as $technology)
                                <label class="align-middle text-center rounded-xl border-none px-2 py-1 leading-none text-gray-500 font-medium uppercase text-sm font-sans bg-black/4 backdrop-blur-lg transition cursor-pointer has-[:checked]:bg-black has-[:checked]:text-white ring-offset-background focus-within:outline-none focus-within:ring-1 focus-within:ring-zinc-800">
                                    <input
                                        class="sr-only"
                                        type="checkbox"
                                        name="technologies[]"
                                        value="{{ $technology->slug }}"
                                        aria-labelledby="{{ $loop->first ? "technologies-heading technology-{$technology->slug}" : "technology-{$technology->slug}" }}"
                                        @if (in_array($technology->slug, old('technologies', []))) checked @endif
                                    />

                                    <span id="technology-{{ $technology->slug }}" class="whitespace-nowrap">{{ $technology->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label id="suggester-heading" for="suggester_name" class="mb-1 block">Tell us about yourself</label>

                        <div class="mb-2 relative group">
                            <label for="suggester_name" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Your name *</label>

                            <input
                                type="text"
                                class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg mt-2 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                name="suggester_name"
                                id="suggester_name"
                                aria-labelledby="suggester-heading suggester_name"
                                placeholder="Firstname Lastname"
                                value="{{ old('suggester_name') }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('suggester_name')" class="mt-2" />
                        </div>

                        <div class="mb-6 relative group">
                            <label for="suggester_email" class="
                                z-10 block absolute top-0 -translate-y-1 ml-2 px-1 py-0 backdrop-blur-lg bg-black/4 rounded-lg text-xs font-normal leading-normal duration-300 ease-out cursor-text
                                text-black
                                group-has-[:placeholder-shown]:z-0 group-has-[:placeholder-shown]:text-transparent group-has-[:placeholder-shown]:top-[17px] group-has-[:placeholder-shown]:ml-3 group-has-[:placeholder-shown]:text-[16px] group-has-[:placeholder-shown]:bg-transparent group-has-[:placeholder-shown]:backdrop-blur-none
                                group-focus-within:!z-10 group-focus-within:!bg-black/4 group-focus-within:!text-black group-focus-within:!top-0 group-focus-within:!ml-2 group-focus-within:!text-xs group-focus-within:!backdrop-blur-lg
                            ">Your email *</label>

                            <input
                                type="email"
                                class="w-96 max-w-full rounded-xl border-none bg-black/4 backdrop-blur-lg my-2 border-gray-300 ring-offset-background placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-zinc-800"
                                name="suggester_email"
                                id="suggester_email"
                                placeholder="you@awesome.com"
                                value="{{ old('suggester_email') }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('suggester_email')" class="mt-2" />
                        </div>
                    </div>

                    <input
                        type="submit"
                        class="float-right block rounded-lg border-none bg-black p-2 px-5 text-sm text-white hover:bg-black/80"
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
