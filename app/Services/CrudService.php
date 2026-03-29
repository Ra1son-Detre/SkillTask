<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\Task;

class CrudService
{
    public function create ( array $data, int $client_id): Task
    {
        $data['client_id'] = $client_id;

        $data['status'] = TaskStatus::DRAFT;

        return Task::create($data);
    }

    public function update (Task $task, array $data): Task
    {
        $task->update($data);

        return $task;
    }

    public function delete (Task $task): void
    {
        $task->delete();
    }
}
