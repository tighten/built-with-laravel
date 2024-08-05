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
                'description' => 'TODO: Write this',
                'image' => '/images/temp/screenshots/missing.png',
                'favicon' => '/images/temp/favicons/missing.png',
                'public_source' => $suggested->public_source,
                'private_source' => $suggested->private_source,
                'published_at' => null,
            ]);

            // Create sites
            foreach ($suggested->sites as $url) {
                $org->sites()->create([
                    'name' => 'TODO Write this',
                    'image' => '/images/temp/screenshots/missing.png',
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
