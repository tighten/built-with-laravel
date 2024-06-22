<?php

namespace App\Livewire;

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;

class OrgsList extends Component
{
    public $filterTechnologies = [];

    #[Computed]
    public function technologies()
    {
        return Technology::whereHas('organizations')->get();
    }

    #[Computed]
    public function organizations()
    {
        // @todo: Can we add technologies to sites instead of orgs and still get this filter?
        return Organization::when(! empty($this->filterTechnologies), function (Builder $query) {
            $query->whereHas('technologies', function (Builder $query) {
                $query->whereIn('slug', $this->filterTechnologies);
            });
        })->with('sites')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.orgs-list');
    }
}
