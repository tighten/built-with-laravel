<x-public-layout>
    <h2 class="text-2xl mb-2">Suggest an organization</h2>

    @if (Session::has('flash'))
        <div class="mb-4 px-4 py-2 bg-blue-100 border border-blue-400 text-blue-900 max-w-5xl">{{ Session::get('flash') }}</div>
    @endif

    <div class="max-w-5xl text-lg">
        <div class="bg-white border p-8 rounded">
            <form method="post" action="{{ route('suggestions.store') }}">
                @csrf
                <div class="mb-8">
                    <label class="block">Organization name</label>
                    <input type="text" class="w-96 max-w-full border-gray-300" name="name" placeholder="Tighten" value="{{ old('name') }}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label class="block">Organization URL</label>
                    <input type="url" class="w-96 max-w-full border-gray-300" name="url" placeholder="https://tighten.com/" value="{{ old('url') }}">
                    <x-input-error :messages="$errors->get('url')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label class="block">How do you know they use Laravel? (if shareable publicly)</label>
                    <textarea class="w-128 h-32 border-gray-300 max-w-full " name="public_source">{{ old('public_source') }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="block">How do you know they use Laravel? (if not shareable publicly)</label>
                    <textarea class="w-128 h-32 border-gray-300 max-w-full" name="private_source">{{ old('private_source') }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="block">What sites/microsites/apps specifically use Laravel? (new line for each URL)</label>
                    <textarea class="w-128 h-32 border-gray-300 max-w-full" name="sites" placeholder="https://fieldgoal.io/">{{ old('sites') }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="block">What technologies are they using?</label>
                    <select name="technologies[]" multiple class="w-64 h-32 border-gray-300">
                        @foreach ($technologies as $technology)
                            <option value="{{ $technology->slug }}" {{ collect(old('technologies'))->contains($technology->slug) ? 'selected' : '' }}>{{ $technology->name }}</option>
                        @endforeach
                    </select>
                </div>

                <hr class="mb-8">

                <div class="mb-8">
                    <label class="block">Your name</label>
                    <input type="text" class="w-96 max-w-full border-gray-300" name="suggester_name" placeholder="You Lastname" value="{{ old('suggester_name') }}">
                    <x-input-error :messages="$errors->get('suggester_name')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label class="block">Your email</label>
                    <input type="email" class="w-96 max-w-full border-gray-300" name="suggester_email" placeholder="you@awesome.com" value="{{ old('suggester_email') }}">
                    <x-input-error :messages="$errors->get('suggester_email')" class="mt-2" />
                </div>

                <hr class="my-8">

                <input type="submit" class="border block p-1 px-3 border border-gray-300 rounded hover:bg-gray-100" value="Submit Suggestion">
            </form>
        </div>
    </div>
</x-public-layout>
