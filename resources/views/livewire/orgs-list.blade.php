<div>
    <div class="mb-8">
        <div class="font-bold">Technologies:</div>

        <div class="flex">
            <a href="/" class="hover:bg-gray-100 hover:border-gray-300 px-3 py-1 border mr-2 rounded {{ $filterTechnology == null ? 'font-bold border-gray-500 hover:border-gray-700 ' : '' }}">All</a>
        @foreach ($this->technologies as $tech)
            <a href="{{ route('technologies.show', $tech->slug) }}" class="hover:bg-gray-100 hover:border-gray-300 px-3 py-1 border mr-2 rounded {{ $filterTechnology == $tech->slug ? 'font-bold border-gray-500 hover:border-gray-700 ' : '' }}">{{ $tech->name }}</a>
        @endforeach
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
