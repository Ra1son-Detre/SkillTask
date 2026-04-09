<?php

namespace Tests\Feature\Api;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientChoosesExecutorTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_client_chooses_executor(): void
    {
        $client = User::factory()->client()->create();

        $executor = User::factory()->executor()->create();

        $task = Task::factory()->for($client, 'client')->create(['status' => TaskStatus::PUBLISHED]);

        $this->actingAs($executor, 'sanctum');

        //Исполнитель откликается
        $response = $this->postJson("/api/v1/tasks/{$task->id}/responses", ['message' => 'Я могу!']);

        $response->assertStatus(201);

        $id = $response->json('data.id');

        $this->actingAs($client, 'sanctum');

        //Клиент выбирает исполнителя
        $response = $this->patchJson("/api/v1/tasks/{$task->id}/responses/{$id}");

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'executor_id' => $executor->id]);
    }
}
