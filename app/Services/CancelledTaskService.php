<?php

namespace App\Services;

use App\Enums\TaskResponseStatus;
use App\Enums\TaskStatus;
use App\Events\ExecutorSelected;
use App\Models\Task;
use App\Notifications\ExecutorSelectedNotification;
use Illuminate\Support\Facades\DB;

class CancelledTaskService
{
public function cancel (Task $task)
{
 DB::transaction(function () use ($task) {

     $task->update(['executor_id' => null]);

     $task->update(['status' => TaskStatus::CANCELLED]);

     $task->responses()->update(['status' => TaskResponseStatus::PENDING]);
 });
}
}
