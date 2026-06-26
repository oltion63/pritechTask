<?php

namespace Database\Factories;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => rand(1, 10),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'closed', 'in_progress']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'due_date' => fake()->date(),
        ];
    }
}
