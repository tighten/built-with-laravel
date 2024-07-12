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
        Technology::create(['name' => 'Alpine.js']);
        Technology::create(['name' => 'Filament']);
        $statamic = Technology::create(['name' => 'Statamic']);

        $user = User::create([
            'name' => 'Matt Stauffer',
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password'),
        ]);

        $tighten = Organization::create([
            'name' => 'Tighten',
            'url' => 'https://tighten.com/',
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
            'name' => 'FieldGoal',
            'url' => 'https://fieldgoal.io/',
            'image' => '/images/temp/screenshots/fieldgoal.jpg',
        ]);

        $tighten->sites()->create([
            'name' => 'Thermostat',
            'url' => 'https://thermostat.io/',
            'image' => '/images/temp/screenshots/thermostat.png',
        ]);

        Organization::create([
            'name' => 'Curology',
            'url' => 'https://curology.com/',
            'image' => '/images/temp/screenshots/curology.png',
            'favicon' => '/images/temp/favicons/curology.png',
            'description' => 'A personalized skincare brand.',
            'submitter_id' => $user->id,
            'public_source' => "They've posted jobs for Laravel.",
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
            'public_source' => 'Taylor named them as using Laravel on Twitter.',
        ]);

        $zillow = Organization::create([
            'name' => 'Zillow',
            'url' => 'https://zillow.com/',
            'favicon' => '/images/temp/favicons/zillow.png',
            'description' => 'An online real-estate marketplace.',
            'submitter_id' => $user->id,
            'public_source' => 'They acquired Aryeo, which uses Laravel.',
        ]);

        $zillow->sites()->create([
            'name' => 'Aryeo',
            'url' => 'https://www.aryeo.com/',
            'image' => '/images/temp/screenshots/aryeo.jpg',
        ]);

        $zillow->technologies()->attach(Technology::create(['name' => 'Inertia']));
        $zillow->technologies()->attach(Technology::create(['name' => 'Vue.js']));

        Organization::create([
            'name' => 'Pfizer',
            'url' => 'https://pfizer.com/',
            'image' => '/images/temp/screenshots/pfizer.png',
            'favicon' => '/images/temp/favicons/pfizer.png',
            'description' => 'A drug company.',
            'submitter_id' => $user->id,
            'public_source' => "They've long employed dozens of Laravel developers, including through several Laravel-based staff augmentation firms.",
        ]);

        $gene = Organization::create([
            'name' => 'Genentech',
            'url' => 'https://gene.com/',
            'favicon' => '/images/temp/favicons/genentech.png',
            'description' => 'A research company.',
            'submitter_id' => $user->id,
            'public_source' => 'Tighten built their site(s).',
        ]);

        $gene->sites()->create([
            'name' => 'Genentech.com',
            'url' => 'https://www.gene.com/',
            'image' => '/images/temp/screenshots/genentech.jpg',
        ]);

        $aic = Organization::create([
            'name' => 'Art Institute of Chicago',
            'url' => 'https://artic.edu/',
            'favicon' => '/images/temp/favicons/aic.png',
            'description' => 'An art institute.',
            'submitter_id' => $user->id,
            'public_source' => 'Tighten has contracted with them.',
        ]);

        $aic->sites()->create([
            'name' => 'Artic.edu',
            'url' => 'https://artic.edu/',
            'image' => '/images/temp/screenshots/aic.jpg',
        ]);

        $aic->technologies()->attach(Technology::create(['name' => 'Twill']));

        /*
        Organization::create([
            'name' => 'Midwest Institute for Sexuality and Gender Diversity',
            'url' => 'https://sgdinstitute.org',
            'image' => '/images/temp/screenshots/misgd.jpg',
            'favicon' => '/images/temp/favicons/misgd.png',
            'description' => 'An all-volunteer organization dedicated to queer and trans success in the Midwest.',
            'submitter_id' => $user->id,
            'public_source' => 'Andy Newhouse developed the sites.',
        ]);
        */

        Organization::create([
            'name' => 'Fathom Analytics',
            'url' => 'https://usefathom.com/',
            'image' => '/images/temp/screenshots/fathom.png',
            'favicon' => '/images/temp/favicons/fathom.png',
            'description' => 'A privacy-focused analytics app.',
            'submitter_id' => $user->id,
            'public_source' => 'Co-founder talks about using Laravel in Fathom.',
        ]);

        $spatie = Organization::create([
            'name' => 'Spatie',
            'url' => 'https://spatie.be/',
            'favicon' => '/images/temp/favicons/spatie.png',
            'description' => 'A Laravel consultancy.',
            'submitter_id' => $user->id,
            'public_source' => 'Founders & employees talk about using Laravel in their apps.',
        ]);

        $spatie->sites()->create([
            'name' => 'Mailcoach',
            'url' => 'https://mailcoach.app/',
            'image' => '/images/temp/screenshots/mailcoach.png',
        ]);

        $spatie->technologies()->attach($statamic);

        $transistor = Organization::create([
            'name' => 'Transistor',
            'url' => 'https://transistor.fm/',
            'favicon' => '/images/temp/favicons/transistor.png',
            'description' => 'A podcast publishing platform.',
            'submitter_id' => $user->id,
            'public_source' => 'Founder talks publicly about using Statamic to power their web site.',
        ]);

        $transistor->sites()->create([
            'name' => 'Transistor.fm',
            'url' => 'https://transistor.fm/',
            'image' => '/images/temp/screenshots/transistor.jpg',
        ]);

        $spiegel = Organization::create([
            'name' => 'Der Spiegel',
            'url' => 'https://spiegel.de/',
            'favicon' => '/images/temp/favicons/spiegel.png',
            'description' => "One of Germany's largest newspapers.",
            'submitter_id' => $user->id,
            'public_source' => 'Jack McDade said so.',
        ]);

        $spiegel->sites()->create([
            'name' => 'Der Spiegel',
            'url' => 'https://spiegel.de',
            'image' => '/images/temp/screenshots/spiegel.jpg',
        ]);

        $spiegel->technologies()->attach($statamic);

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
