<x-public-layout>
    <div class="mx-auto max-w-5xl">
        <h2 class="mb-2 text-2xl">Suggest an organization</h2>

        @if (Session::has('flash'))
            <div class="mb-4 max-w-5xl border border-blue-400 bg-blue-100 px-4 py-2 text-blue-900">
                {{ Session::get('flash') }}
            </div>
        @endif

        <div class="rounded border bg-white/10 p-4 text-lg backdrop-blur-sm md:p-8">
            <form method="post" action="{{ route('suggestions.store') }}">
                @csrf
                <div class="mb-8">
                    <label class="block">Organization name *</label>
                    <input
                        type="text"
                        class="w-96 max-w-full border-gray-300"
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
                        class="w-96 max-w-full border-gray-300"
                        name="url"
                        placeholder="https://tighten.com/"
                        value="{{ old('url') }}"
                    />
                    <x-input-error :messages="$errors->get('url')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label class="block">
                        Public: How do you know they use Laravel?
                        <br />
                        <span class="text-sm italic text-gray-500">
                            (if this information
                            <strong>can</strong>
                            safely be shared publicly)
                        </span>
                    </label>
                    <textarea class="h-32 w-128 max-w-full border-gray-300" name="public_source">
{{ old('public_source') }}</textarea
                    >
                </div>

                <div class="mb-8">
                    <label class="block">
                        Private: How do you know they use Laravel?
                        <br />
                        <span class="text-sm italic text-gray-500">
                            (if this information
                            <strong>cannot</strong>
                            safely be shared publicly)
                        </span>
                    </label>
                    <textarea class="h-32 w-128 max-w-full border-gray-300" name="private_source">
{{ old('private_source') }}</textarea
                    >
                </div>

                <div class="mb-8">
                    <label class="block">
                        What sites/microsites/apps specifically use Laravel? (new line for each URL)
                    </label>
                    <textarea
                        class="h-32 w-128 max-w-full border-gray-300"
                        name="sites"
                        placeholder="https://fieldgoal.io/"
                    >
{{ old('sites') }}</textarea
                    >
                </div>

                <div class="mb-8">
                    <label class="block">What technologies are they using?</label>
                    <select name="technologies[]" multiple class="h-32 w-64 border-gray-300">
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

                <hr class="mb-8" />

                <div class="mb-8">
                    <label class="block">Your name *</label>
                    <input
                        type="text"
                        class="w-96 max-w-full border-gray-300"
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
                        class="w-96 max-w-full border-gray-300"
                        name="suggester_email"
                        placeholder="you@awesome.com"
                        value="{{ old('suggester_email') }}"
                    />
                    <x-input-error :messages="$errors->get('suggester_email')" class="mt-2" />
                </div>

                <hr class="my-8" />

                <input
                    type="submit"
                    class="block rounded border border-gray-300 p-1 px-3 hover:bg-gray-100"
                    value="Submit Suggestion"
                />
            </form>
        </div>
    </div>
</x-public-layout>
