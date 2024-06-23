<?php

namespace App\Livewire;

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;

class OrgsList extends Component
{
    public function __construct(public $filterTechnology = null)
    {
        // @todo: Change navigation to filter/not filter technology to be on the same livewire page, even with URL changing
    }

    #[Computed]
    public function technologies()
    {
        return Technology::whereHas('organizations')->get();
    }

    #[Computed]
    public function organizations()
    {
        // @todo: Can we add technologies to sites instead of orgs and still get this filter?
        return Organization::when(! is_null($this->filterTechnology), function (Builder $query) {
                $query->whereHas('technologies', function (Builder $query) {
                    $query->where('slug', $this->filterTechnology);
                });
            })->with('sites')
            ->with('technologies')
            ->orderBy('featured_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.orgs-list');
    }
}
