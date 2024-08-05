<?php

namespace App\Actions;

use App\Models\Organization;
use App\Models\SuggestedOrganization;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApproveSuggestedOrganization
{
    public function __invoke(SuggestedOrganization $suggested)
    {
        Log::info('Approving suggested organization ' . $suggested->id);

        DB::transaction(function () use ($suggested) {
            // Create organization
            $org = Organization::create([
                'name' => $suggested->name,
                'url' => $suggested->url,
                'description' => 'Todo write this', // @todo Add to suggested and let me write in Filament
                'image' => 'Todo build this', // @todo Add to suggested and let me write in Filament
                'favicon' => 'Todo build this', // @todo Add to suggested and let me write in Filament
                'public_source' => $suggested->public_source,
                'private_source' => $suggested->private_source,
                'published_at' => null,
            ]);

            // Create sites
            foreach ($suggested->sites as $url) {
                $org->sites()->create([
                    'name' => 'TBD', // @todo Allow this to be set in Filament, too
                    'image' => 'tbd', // @todo Allow this to be set in Filament, too
                    'url' => $url,
                ]);
            }

            // Attach technologies
            foreach ($suggested->technologies as $technology) {
                $org->technologies()->attach(Technology::where('slug', $technology)->first());
            }

            $suggested->update(['approved_at' => now()]);
        });

        Log::info('Finished approving suggested organization ' . $suggested->id);
    }
}
