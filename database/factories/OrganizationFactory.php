<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'url' => $this->faker->url(),
            'image' => $this->faker->url(),
            'favicon' => $this->faker->url(),
            'description' => $this->faker->sentence(),
            'published_at' => now(),
        ];
    }
}
