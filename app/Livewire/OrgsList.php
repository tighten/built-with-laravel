<?php

namespace App\Livewire;

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class OrgsList extends Component
{
    #[Url()]
    public ?string $technology = '';

    #[Computed(cache: true, key: 'active-technologies')]
    public function technologies()
    {
        return Technology::whereHas('organizations')->orderBy('name')->get();
    }

    #[Computed]
    public function organizations()
    {
        return Cache::remember('orgs-list-filter[' . $this->technology . ']', 3600, function () {
            return Organization::query()
                ->when($this->technology, function (Builder $query) {
                    $query->whereHas('technologies', function (Builder $query) {
                        $query->where('slug', $this->technology);
                    });
                })
                ->with('sites') // @todo: Do a subquery for just the first site aaron francis style?
                ->orderBy('featured_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.orgs-list');
    }
}
