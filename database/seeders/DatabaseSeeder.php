<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Site;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Real data

        Technology::create(['name' => 'React']);
        Technology::create(['name' => 'Angular']);
        Technology::create(['name' => 'Alpine.js']);
        Technology::create(['name' => 'Statamic']);

        $user = User::create([
            'name' => 'Matt Stauffer',
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password'),
        ]);

        $tighten = Organization::create([
            'name' => 'Tighten',
            'url' => 'https://tighten.com/',
            'image' => '/images/temp/screenshots/tighten.png',
            'favicon' => '/images/temp/favicons/tighten.png',
            'description' => 'A Laravel consultancy.',
            'public_source' => 'Let us count the ways.',
            'submitter_id' => $user->id,
        ]);

        $tighten->technologies()->createMany([
            ['name' => 'Jigsaw'],
            ['name' => 'Livewire'],
        ]);

        $tighten->sites()->create([
            'name' => 'Thermostat',
            'url' => 'https://thermostat.io/',
        ]);

        $tighten->sites()->create([
            'name' => 'FieldGoal',
            'url' => 'https://fieldgoal.io/',
        ]);

        Organization::create([
            'name' => 'Apple',
            'url' => 'https://apple.com/',
            'image' => '/images/temp/screenshots/apple.png',
            'favicon' => '/images/temp/favicons/apple.png',
            'description' => 'A personal electronics technology company.',
            'submitter_id' => $user->id,
            'public_source' => "They've posted jobs for Laravel.",
            'featured_at' => now(),
        ]);

        Organization::create([
            'name' => 'Square',
            'url' => 'https://square.com/',
            'image' => '/images/temp/screenshots/square.png',
            'favicon' => '/images/temp/favicons/square.png',
            'description' => 'A payments technology company.',
            'submitter_id' => $user->id,
            'public_source' => "Taylor named them as using Laravel on Twitter.",
        ]);

        $zillow = Organization::create([
            'name' => 'Zillow',
            'url' => 'https://zillow.com/',
            'image' => '/images/temp/screenshots/zillow.png',
            'favicon' => '/images/temp/favicons/zillow.png',
            'description' => 'An online real-estate marketplace.',
            'submitter_id' => $user->id,
            'public_source' => "They acquired Aryeo, which uses Laravel.",
        ]);

        $zillow->sites()->create([
            'name' => 'Aryeo',
            'url' => 'https://www.aryeo.com/',
        ]);

        $zillow->technologies()->attach(Technology::create(['name' => 'Inertia']));
        $zillow->technologies()->attach(Technology::create(['name' => 'Vue.js']));

        Organization::create([
            'name' => 'Pfizer',
            'url' => 'https://pfizer.com/',
            'image' => '/images/temp/screenshots/pfizer.jpg',
            'favicon' => '/images/temp/favicons/pfizer.png',
            'description' => 'A drug company.',
            'submitter_id' => $user->id,
            'public_source' => "Thye've long employed dozens of Laravel developers, including through several Laravel-based staff augmentation firms.",
        ]);

        Organization::create([
            'name' => 'Genentech',
            'url' => 'https://gene.com/',
            'image' => '/images/temp/screenshots/genentech.jpg',
            'favicon' => '/images/temp/favicons/genentech.png',
            'description' => 'A research company.',
            'submitter_id' => $user->id,
            'public_source' => "Tighten built their site(s).",
        ]);

        $aic = Organization::create([
            'name' => 'Art Institute of Chicago',
            'url' => 'https://artic.edu/',
            'image' => '/images/temp/screenshots/aic.jpg',
            'favicon' => '/images/temp/favicons/aic.png',
            'description' => 'An art institute.',
            'submitter_id' => $user->id,
            'public_source' => "Tighten has contracted with them.",
        ]);

        $aic->sites()->create([
            'name' => 'Artic.edu',
            'url' => 'https://artic.edu/',
        ]);

        $aic->technologies()->attach(Technology::create(['name' => 'Twill']));

        Organization::create([
            'name' => 'Fathom Analytics',
            'url' => 'https://usefathom.com/',
            'image' => '/images/temp/screenshots/fathom.png',
            'favicon' => '/images/temp/favicons/fathom.png',
            'description' => 'A privacy-focused analytics app.',
            'submitter_id' => $user->id,
            'public_source' => "Co-founder talks about using Laravel in Fathom.",
        ]);

        $spatie = Organization::create([
            'name' => 'Spatie',
            'url' => 'https://spatie.be/',
            'image' => '/images/temp/screenshots/spatie.jpg',
            'favicon' => '/images/temp/favicons/spatie.png',
            'description' => 'A Laravel consultancy.',
            'submitter_id' => $user->id,
            'public_source' => "Founders & employees talk about using Laravel in their apps.",
        ]);

        $spatie->sites()->create([
            'name' => 'Mailcoach',
            'url' => 'https://mailcoach.app/',
        ]);

        // Does Flare fit? It's targeting Laravel devs so it's not exactly what we're looking for...

        // Do laracasts and codecourse fit in?

        // Fake data

        // if (app()->environment() === 'production') {
            return;
        // }

        $otherUser = User::factory()->create();

        Technology::factory()->count(5)->create();

        $orgs = Organization::factory()
            ->count(10)
            ->create([
                'submitter_id' => $user->id,
            ])
            ->each(function ($org) {
                $org->technologies()->attach(Technology::all()->random());
                $org->technologies()->attach(Technology::all()->random());
            });


        Site::factory()
            ->create([
                'organization_id' => $orgs[0]->id,
            ]);
    }
}
