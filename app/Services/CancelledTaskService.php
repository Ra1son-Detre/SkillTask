<?php

namespace App\Services;

use App\Enums\TaskResponseStatus;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class CancelledTaskService
{
    public function cancel(Task $task): void
    {
        DB::transaction(function () use ($task) {
            $task->update([
                'executor_id' => null,
                'status' => TaskStatus::CANCELLED,
            ]);

            $task->responses()->update([
                'status' => TaskResponseStatus::PENDING,
            ]);
        });
    }
}
