<?php

namespace App\Services;
use App\Enums\TaskResponseStatus;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Models\User;

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
        if($task->executor_id !== null) {
            abort(403);
        }
//        if($task->responses()->where('executor_id', $user->id)->exists()) {
//            abort(403);
//        }

        TaskResponse::create([
            'task_id' => $task->id,
            'executor_id' => $user->id,
            'message' => $message,
            'status' => TaskResponseStatus::PENDING,
        ]);
    }
}
