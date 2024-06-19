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
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

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
                'submitter_id' => $otherUser->id,
            ]);

        Site::factory()
            ->create([
                'submitter_id' => $user->id,
            ]);

        Site::factory()
            ->create([
                'organization_id' => $orgs[0]->id,
                'submitter_id' => $user->id,
            ]);

        Site::factory()
            ->create([
                'submitter_id' => $otherUser->id,
            ]);
    }
}
