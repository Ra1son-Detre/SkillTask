<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{

    private function validData(array $changed = [])
    {
        return array_merge([
            'id' => 1,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'client',
            ],
            $changed);
    }


    public function test_user_can_register(): void
    {
        $data = $this->validData();

        $response = $this->postJson('/api/v1/auth/register', $data);

        $response->assertStatus(201);

        $response->assertJsonStructure(['user' => [
                'id',
                'name',
                'email',
                'role',
         ]]);

        $response->assertJson(['user' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'Клиент',
            ],
        ]);

        $this->assertDatabaseHas('users', ['email' => $data['email']]);
    }

    public function test_user_failed_email_validation(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            $this->validData(['email' => 'invalid-email']),
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('email');
    }

    public function test_user_failed_name_validation(): void
    {
        $response = $this->postJson('/api/v1/auth/register', $this->validData(['name' => 'S']));

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('name');
    }

    public function test_user_failed_password_validation(): void
    {
        $response = $this->postJson('/api/v1/auth/register', $this->validData(['password' => '']));

        $response->assertStatus(422);

        $response->assertJsonValidationErrors('password');
    }
}
