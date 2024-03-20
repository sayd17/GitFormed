<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Repository;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PullRequest>
 */
class PullRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'owner' => Repository::factory(),
            'repo_name' => Repository::factory(),
        ];
    }
}
