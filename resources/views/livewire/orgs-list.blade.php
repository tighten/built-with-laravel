<div>
    <div class="mb-10">
        <div class="flex justify-center flex-wrap gap-2 max-w-full">
            <a href="/" class="bg-white hover:bg-gray-100 hover:border-gray-300 dark:hover:bg-gray-900 dark:hover:border-gray-400 px-3 py-1 border rounded {{ $filterTechnology == null ? 'font-bold border-gray-500 dark:border-gray-400 hover:border-gray-700 ' : 'dark:border-gray-600' }}">All Technologies</a>
        @foreach ($this->technologies as $tech)
            <a href="{{ route('technologies.show', $tech->slug) }}" class="bg-white hover:bg-gray-100 hover:border-gray-300 dark:hover:bg-gray-900 dark:hover:border-gray-400 px-3 py-1 border rounded {{ $filterTechnology == $tech->slug ? 'font-bold border-gray-500 dark:border-gray-400 hover:border-gray-700 ' : 'dark:border-gray-600' }}">{{ $tech->name }}</a>
        @endforeach
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
