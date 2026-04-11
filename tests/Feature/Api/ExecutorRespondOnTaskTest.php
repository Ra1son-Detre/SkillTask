<?php

namespace Tests\Feature\Api;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExecutorRespondOnTaskTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function test_executor_respond_on_task_but_not_twice(): void
    {
        $client = User::factory()->client()->create();

        $executor = User::factory()->executor()->create();

        $this->actingAs($executor, 'sanctum');

        $task = Task::factory()->for($client, 'client')->create(['status' => TaskStatus::PUBLISHED]);


        $response = $this->postJson("/api/v1/tasks/{$task->id}/responses", ['message'=> 'Я могу!']);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'message',
                'executor' => [
                    'id',
                    'name',
                    'email',
                ],
                'responded_at',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'message' => 'Я могу!',
                'executor' => [
                    'id' => $executor->id,
                    'name' => $executor->name,
                    'email' => $executor->email,
                ],
            ],
        ]);

        //Попытка повторного отклика//

        $responseTwice = $this->postJson("/api/v1/tasks/{$task->id}/responses", ['message'=> 'Я могу!']);

        $responseTwice->assertStatus(403);

        $this->assertDatabaseCount('task_responses', 1);

    }

}
