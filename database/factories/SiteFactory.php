<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = Site::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'url' => $this->faker->url(),
            'image' => $this->faker->url(),
            'published_at' => $this->faker->dateTime(),
            'submitter_id' => User::factory(),
            'organization_id' => Organization::factory(),
        ];
    }
}
