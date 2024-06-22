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
            'name' => 'Tighten.com',
            'url' => 'https://tighten.com/',
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
        ]);

        Organization::create([
            'name' => 'Square',
            'url' => 'https://square.com/',
            'image' => 'image.com',
            'description' => 'A technology company.',
            'submitter_id' => $user->id,
        ]);

        $zillow = Organization::create([
            'name' => 'Zillow',
            'url' => 'https://zillow.com/',
            'image' => 'image.com',
            'description' => 'A technology company.',
            'submitter_id' => $user->id,
        ]);

        $zillow->sites()->create([
            'name' => 'Aryeo',
            'url' => 'https://www.aryeo.com/',
        ]);

        Organization::create([
            'name' => 'Pfizer',
            'url' => 'https://pfizer.com/',
            'image' => 'image.com',
            'description' => 'A drug company.',
            'submitter_id' => $user->id,
        ]);

        Organization::create([
            'name' => 'Genentech',
            'url' => 'https://gene.com/',
            'image' => 'image.com',
            'description' => 'A research company.',
            'submitter_id' => $user->id,
        ]);

        $aic = Organization::create([
            'name' => 'Art Institute of Chicago',
            'url' => 'https://artic.edu/',
            'image' => 'image.com',
            'description' => 'An art institute.',
            'submitter_id' => $user->id,
        ]);

        $aic->sites()->create([
            'name' => 'Artic.edu',
            'url' => 'https://artic.edu/',
        ]);

        $aic->technologies()->attach(Technology::create(['name' => 'Twill', 'slug' => 'twill']));

        // Fake data

        if (app()->environment() === 'production') {
            return;
        }

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
