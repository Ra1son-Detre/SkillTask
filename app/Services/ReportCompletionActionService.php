<?php

namespace App\Services;
use App\Enums\TaskStatus;
use App\Events\ExecutorCompletedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ReportCompletionActionService
{
    public function execute(Task $task): void
    {
        if ($task->status !== TaskStatus::IN_PROGRESS) {
            abort(403);
        }

        DB::transaction(function () use ($task) {

            $task->update(['status' => TaskStatus::AWAITING_CONFIRMATION]);

            event(new ExecutorCompletedTask($task));
        });
    }
}
