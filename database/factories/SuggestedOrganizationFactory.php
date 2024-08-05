<?php

namespace Database\Factories;

use App\Models\SuggestedOrganization;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuggestedOrganizationFactory extends Factory
{
    protected $model = SuggestedOrganization::class;

    public function definition(): array
    {
        $technologies = Technology::inRandomOrder()->limit(2)->get();

        return [
            'name' => $this->faker->name(),
            'url' => $this->faker->url(),
            'public_source' => $this->faker->sentence(),
            'private_source' => $this->faker->sentence(),
            'sites' => [$this->faker->url(), $this->faker->url()],
            'technologies' => $technologies,
            'suggester_name' => $this->faker->name(),
            'suggester_email' => $this->faker->email(),
        ];
    }
}
