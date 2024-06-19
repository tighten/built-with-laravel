<?php

namespace Database\Factories;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnologyFactory extends Factory
{
    protected $model = Technology::class;

    public function definition(): array
    {
        $slug = $this->faker->word();

        return [
            'name' => ucwords($slug),
            'slug' => $slug,
        ];
    }
}
