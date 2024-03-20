<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Repository;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Watcher>
 */
class WatcherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'repo_name' => Repository::factory(),
            'owner' => Repository::factory(),
            'username' => User::factory(),

        ];
    }
}
