<div>
    <div class="mb-8">
        <div class="font-bold">Technologies:</div>

        @foreach ($this->technologies as $tech)
            <label class="mr-2"><input type="checkbox" value="{{ $tech->slug }}" wire:model.live="filterTechnologies"> {{ $tech->name }}</label>
        @endforeach
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($this->organizations as $org)
            <x-org-in-list :org="$org"></x-org-in-list>
        @endforeach
    </div>
</div>
