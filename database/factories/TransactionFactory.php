<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => 100000,
            'task_id' => null,
            'type' => PaymentStatus::DEPOSIT,
        ];
    }

    public function deposit(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => PaymentStatus::DEPOSIT,
            ];
        });
    }

    public function taskPayment(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => PaymentStatus::TASK_PAYMENT,
                'task_id' => Task::factory(),
            ];
        });
    }
}
