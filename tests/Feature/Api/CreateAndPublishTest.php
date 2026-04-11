<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class CreateAndPublishTest extends TestCase
{
    use RefreshDatabase;

    private function taskdData(array $changed = [])
    {
        return array_merge(
            Task::factory()->make()->toArray(),
            $changed);
    }

    public function test_client_create_task(): void
    {
        $client = User::factory()->client()->create();

        $this->actingAs($client, 'sanctum');

        $taskData = $this->taskdData();

        $response = $this->postJson('/api/v1/tasks', $taskData);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'price',
                'status',
                'created_at',
                'updated_at',
            ]
        ]);

        $id = $response->json('data.id');

        $response->assertJson([
            'data' => [
                'id' => $id,
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'price' => $taskData['price'],
                'status' => 'Черновик',
            ]
        ]);
    }


    public function test_client_published_task(): void
    {
        $client = User::factory()->client()->create();

        $this->actingAs($client, 'sanctum');

        $taskData = Task::factory()->for($client, 'client')->create();

        $newStatus = 'published';


        $response = $this->patchJson("/api/v1/tasks/{$taskData->id}/publish", ['status' => $newStatus]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'price',
                'status',
                'created_at',
                'updated_at',
            ]
        ]);

        $response->assertJson([
            'data' => [
                'id' => $taskData['id'],
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'price' => $taskData['price'],
                'status' => 'Опубликована',
            ]
        ]);
    }
}
