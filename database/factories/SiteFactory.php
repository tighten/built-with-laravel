<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Site;
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
            'organization_id' => Organization::factory(),
        ];
    }
}
