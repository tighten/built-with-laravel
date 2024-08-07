<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\Site;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateSeededImagesToDo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-seeded-images-to-do';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database entries for all pre-seeded images to point to their respective locations in Digital Ocean.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating all organizations...');

        Organization::all()->each(function ($org) {
            if (Str::contains($org->favicon, '/images/temp/favicons')) {
                $org->update([
                    'favicon' => str_replace(
                        '/images/temp/favicons',
                        'images/organizations/favicons',
                        $org->favicon
                    )
                ]);
            }

            if (Str::contains($org->image, '/images/temp/screenshots')) {
                $org->update([
                    'image' => str_replace(
                        '/images/temp/screenshots',
                        'images/organizations/images',
                        $org->image
                    )
                ]);
            }
        });

        $this->info('Updating all sites...');

        Site::all()->each(function ($site) {
            if (Str::contains($site->image, '/images/temp/screenshots')) {
                $site->update([
                    'image' => str_replace(
                        '/images/temp/screenshots',
                        'images/sites',
                        $site->image
                    )
                ]);
            }
        });

        $this->info('Update complete!');
    }
}
