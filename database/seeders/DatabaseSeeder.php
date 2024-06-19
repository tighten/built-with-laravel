<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Site;
use App\Models\Technology;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Real data

        $user = User::factory()->create([
            'name' => 'Matt Stauffer',
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password')
        ]);

        $tighten = Organization::create([
            'name' => 'Tighten',
            'url' => 'https://tighten.com/',
            'image' => 'image.com',
            'description' => 'A group of delightful programmers.',
            'submitter_id' => $user->id,
        ]);

        $tighten->sites()->create([
            'name' => 'Tighten.com',
            'url' => 'https://tighten.com/',
        ]);

        // Fake data

        $otherUser = User::factory()->create();

        Technology::factory()->count(2)->create();

        $orgs = Organization::factory()
            ->hasTechnologies(2)
            ->count(2)
            ->create([
                'submitter_id' => $user->id,
            ]);

        Organization::factory()
            ->hasTechnologies(1)
            ->create([
            ]);

        Site::factory()
            ->create([
            ]);

        Site::factory()
            ->create([
                'organization_id' => $orgs[0]->id,
            ]);

        Site::factory()
            ->create([
            ]);
    }
}
