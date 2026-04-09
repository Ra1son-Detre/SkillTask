<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{

    public function definition(): array
    {
        return [
            'client_id' => User::factory()->client(),
            'executor_id' => null,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'status' => TaskStatus::DRAFT,
            'completed_at' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TaskStatus::PUBLISHED,
            ];
        });
    }

    public function inProgress(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TaskStatus::IN_PROGRESS,
                'executor_id' => User::factory()->executor(),
            ];
        });
    }

    public function completed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TaskStatus::COMPLETED,
                'executor_id' => User::factory()->executor(),
                'completed_at' => now(),
            ];
        });
    }
}
