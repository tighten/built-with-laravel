<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class OrganizationController extends Controller
{
    public function index(Technology $technology)
    {
        return view('organizations.index', [
            'filterTechnology' => $technology,
            'organizations' => $this->organizations($technology),
            'technologies' => $this->technologies(),
        ]);
    }

    public function show(Organization $organization)
    {
        return view('organizations.show', [
            'organization' => $organization,
        ]);
    }

    private function organizations(Technology $technology)
    {
        return Cache::remember('orgs-list-filter[' . $technology->slug . ']', 3600, function () use ($technology) {
            return Organization::query()
                ->when($technology->exists, function (Builder $query) use ($technology) {
                    $query->whereHas('technologies', function (Builder $query) use ($technology) {
                        $query->where('id', $technology->id);
                    });
                })
                ->with('sites') // @todo: Do a subquery for just the first site aaron francis style?
                ->orderBy('featured_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }

    private function technologies()
    {
        return Cache::remember('active-organizations', 3600, function () {
            return Technology::whereHas('organizations')->orderBy('name')->get();
        });
    }
}
