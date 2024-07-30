<?php

use App\Models\Organization;
use App\Models\Technology;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('page-cache:warmup', function () {
    $this->call('page-cache:clear');

    $this->components->info('Making requests to warm up page caches...');

    Http::pool(function (Pool $pool) {
        $requests = [
            $pool->get(route('home')),
        ];

        // Organization pages...
        Organization::query()->oldest()->eachById(function (Organization $organization) use ($requests, $pool) {
            $requests[] = $pool->get(route('organizations.show', $organization));
        });

        // Technology pages...
        Technology::query()->oldest()->eachById(function (Technology $technology) use ($requests, $pool) {
            $requests[] = $pool->get(route('home', ['technology' => $technology]));
        });

        return $requests;
    });

    $this->components->info('Done!');
})->purpose('Makes requests to the website so we can warmup page cache.');
