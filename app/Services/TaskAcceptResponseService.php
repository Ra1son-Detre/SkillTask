<?php

namespace App\Services;

use App\Enums\TaskResponseStatus;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskAcceptResponseService
{
    public function chooseExecutor(Task $task, TaskResponse $response)
    {
        DB::transaction(function () use ($task, $response) {
                $response->update(['status' => TaskResponseStatus::ACCEPTED]);
                $task->responses()->where('id', '!=', $response->id)->update(['status' => TaskResponseStatus::REJECTED]);
                $task->update(['executor_id' => $response->executor_id, 'status' => TaskStatus::IN_PROGRESS]);

        });
    }
}
