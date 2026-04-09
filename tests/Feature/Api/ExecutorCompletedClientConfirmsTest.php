<?php

namespace Tests\Feature\Api;

use App\Enums\PaymentStatus;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExecutorCompletedClientConfirmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_executor_execute_client_confirm_and_pay(): void
    {
        $client = User::factory()->client()->create();

        $executor = User::factory()->executor()->create();

        $task = Task::factory()->for($client, 'client')->create(['status' => TaskStatus::PUBLISHED]);

        // Пополняем баланс создаем входящую транзакцию
        Transaction::factory()->create(['user_id' => $client->id, 'task_id' => $task->id]);

        // исполнитель откликается на задачу
        $this->actingAs($executor, 'sanctum');
        $response = $this->postJson("/api/v1/tasks/{$task->id}/responses", ['message' => 'Я могу!']);
        $responseId = $response->json('data.id');
        $response->assertStatus(201);

        // Клиент выбирает исполнителя
        $this->actingAs($client, 'sanctum');
        $responseChooseExecutor = $this->patchJson("/api/v1/tasks/{$task->id}/responses/{$responseId}");
        $responseChooseExecutor->assertStatus(200);

        // Исполнитель выполняет задачу
        $this->actingAs($executor, 'sanctum');
        $responseExecutorCompleted = $this->patchJson("/api/v1/tasks/{$task->id}/execute");
        $responseExecutorCompleted->assertStatus(200);

        // Клиент подтверждает и оплачивает задачу
        $this->actingAs($client, 'sanctum');
        $responseClientConfirm = $this->patchJson("/api/v1/tasks/{$task->id}/confirm");
        $responseClientConfirm->assertStatus(200);

        // Проверяем что есть 3 (поплнение тоже) транзакции в базе и что статус задачи в базе поменялся
        $this->assertDatabaseCount('transactions', 3);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'status' => TaskStatus::COMPLETED,]);
    }
}
