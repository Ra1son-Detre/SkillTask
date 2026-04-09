<?php

namespace Database\Factories;

use App\Models\TaskResponse;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Task;
use App\Enums\TaskResponseStatus;

/**
 * @extends Factory<TaskResponse>
 */
class TaskResponseFactory extends Factory
{

    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'executor_id' => User::factory()->executor(),
            'message' => fake()->sentence(),
            'status' => TaskResponseStatus::PENDING,
        ];
    }

    public function accepted(): static
    {
        return $this->state(fn () => [
            'status' => TaskResponseStatus::ACCEPTED,
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => TaskResponseStatus::REJECTED,
        ]);
    }
}
