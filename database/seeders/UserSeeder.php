<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->client()->create();

        User::factory()->count(5)->executor()->create();

        User::factory()->create([
            'name' => 'Admin',
            'role' => UserRole::ADMIN,
            'email' => 'admin@test.com'
        ]);
    }
}
