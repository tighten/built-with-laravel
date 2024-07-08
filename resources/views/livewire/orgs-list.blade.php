<div>
    <div class="mb-10">
        <div class="flex justify-center flex-wrap uppercase font-bold">
            <a href="/" class="px-3 py-1 border-b-2 active:text-tighten-yellow active:border-tighten-yellow {{ $filterTechnology == null ? 'border-tighten-yellow hover:border-tighten-yellow text-black' : 'text-gray-400 hover:text-gray-600 hover:border-gray-400 ' }}">All Technologies</a>
            @foreach ($this->technologies as $tech)
                <a href="{{ route('technologies.show', $tech->slug) }}" class="px-3 py-1 border-b-2 active:text-tighten-yellow active:border-tighten-yellow {{ $filterTechnology == $tech->slug ? 'border-tighten-yellow hover:border-tighten-yellow text-black ' : 'text-bgrey-400 hover:text-gray-600 hover:border-gray-400 ' }}">{{ $tech->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
