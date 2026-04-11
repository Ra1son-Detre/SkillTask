<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = User::where('role', UserRole::CLIENT)->get();

        foreach ($clients as $client) {
            Task::factory()->count(5)->create(['client_id' => $client->id]);
        };
    }
}
