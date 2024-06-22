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

        $user = User::create([
            'name' => 'Matt Stauffer',
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password'),
        ]);

        $tighten = Organization::create([
            'name' => 'Tighten',
            'url' => 'https://tighten.com/',
            'image' => 'image.com',
            'description' => 'A group of delightful programmers.',
            'submitter_id' => $user->id,
        ]);

        $tighten->technologies()->create([
            'name' => 'Jigsaw',
            'slug' => 'jigsaw',
        ]);

        $tighten->technologies()->create([
            'name' => 'Livewire',
            'slug' => 'livewire',
        ]);

        $tighten->sites()->create([
            'name' => 'Thermostat',
            'url' => 'https://thermsotat.io/',
        ]);

        $tighten->sites()->create([
            'name' => 'FieldGoal',
            'url' => 'https://fieldgoal.io/',
        ]);

        Organization::create([
            'name' => 'Apple',
            'url' => 'https://apple.com/',
            'image' => 'image.com',
            'description' => 'A technology company.',
            'submitter_id' => $user->id,
            'public_source' => "They've posted jobs for Laravel.",
        ]);

        Organization::create([
            'name' => 'Square',
            'url' => 'https://square.com/',
            'image' => 'image.com',
            'description' => 'A technology company.',
            'submitter_id' => $user->id,
            'public_source' => "Taylor named them as using Laravel on Twitter.",
        ]);

        $zillow = Organization::create([
            'name' => 'Zillow',
            'url' => 'https://zillow.com/',
            'image' => 'image.com',
            'description' => 'An online real-estate marketplace.',
            'submitter_id' => $user->id,
            'public_source' => "They acquired Aryeo, which uses Laravel.",
        ]);

        $zillow->sites()->create([
            'name' => 'Aryeo',
            'url' => 'https://www.aryeo.com/',
        ]);

        $zillow->technologies()->attach(Technology::create(['name' => 'Inertia', 'slug' => 'inertia']));
        $zillow->technologies()->attach(Technology::create(['name' => 'Vue.js', 'slug' => 'vue-js']));

        Organization::create([
            'name' => 'Pfizer',
            'url' => 'https://pfizer.com/',
            'image' => 'image.com',
            'description' => 'A drug company.',
            'submitter_id' => $user->id,
            'public_source' => "Thye've long employed dozens of Laravel developers, including through several Laravel-based staff augmentation firms.",
        ]);

        Organization::create([
            'name' => 'Genentech',
            'url' => 'https://gene.com/',
            'image' => 'image.com',
            'description' => 'A research company.',
            'submitter_id' => $user->id,
            'public_source' => "Tighten built their site(s).",
        ]);

        $aic = Organization::create([
            'name' => 'Art Institute of Chicago',
            'url' => 'https://artic.edu/',
            'image' => 'image.com',
            'description' => 'An art institute.',
            'submitter_id' => $user->id,
            'public_source' => "Tighten has contracted with them.",
        ]);

        $aic->sites()->create([
            'name' => 'Artic.edu',
            'url' => 'https://artic.edu/',
        ]);

        $aic->technologies()->attach(Technology::create(['name' => 'Twill', 'slug' => 'twill']));

        Organization::create([
            'name' => 'Fathom Analytics',
            'url' => 'https://usefathom.com/',
            'image' => 'image.com',
            'description' => 'A privacy-focused analytics app.',
            'submitter_id' => $user->id,
            'public_source' => "Co-founder talks about using Laravel in Fathom.",
        ]);

        $spatie = Organization::create([
            'name' => 'Spatie',
            'url' => 'https://spatie.be/',
            'image' => 'image.com',
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
