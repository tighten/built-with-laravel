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
        return Organization::when(! empty($this->filterTechnologies), function (Builder $query) {
            $query->whereHas('technologies', function (Builder $query) {
                $query->whereIn('slug', $this->filterTechnologies);
            });
        })->get();
    }

    public function render()
    {
        return view('livewire.orgs-list');
    }
}
