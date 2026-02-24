<?php

namespace App\Services;
use App\Http\Requests\Task\TaskResponseRequest;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskResponse;
use App\Enums\UserRole;
use App\Enums\TaskStatus;
use App\Enums\TaskResponseStatus;
use Illuminate\Support\Facades\DB;
class TaskResponseService
{
    public function respond (User $user, Task $task, string $message)
    {
        if($user->role !== UserRole::EXECUTOR) {
            abort(403);
        }
        if($task->status !== TaskStatus::PUBLISHED) {
            abort(403);
        }

        TaskResponse::create([
            'task_id' => $task->id,
            'executor_id' => $user->id,
            'message' => $message,
            'status' => TaskResponseStatus::PENDING,
        ]);
    }
}
