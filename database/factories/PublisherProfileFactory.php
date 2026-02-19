<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublisherProfile>
 */
class PublisherProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'summary' => fake()->optional()->paragraph(3),
            'website_url' => fake()->optional()->url(),
            'user_id' => User::factory(), // automatically make owner
        ];
    }
}
