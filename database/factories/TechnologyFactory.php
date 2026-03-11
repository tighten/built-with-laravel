<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TechnologyFactory extends Factory
{
    public function definition(): array
    {
        $slug = $this->faker->word();

        return [
            'name' => ucwords($slug),
            'slug' => $slug,
        ];
    }
}
