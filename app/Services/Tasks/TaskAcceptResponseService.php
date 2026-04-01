<?php

namespace App\Services\Tasks;

use App\Enums\TaskResponseStatus;
use App\Enums\TaskStatus;
use App\Events\ExecutorSelected;
use App\Models\Task;
use App\Models\TaskResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskAcceptResponseService
{
    public function chooseExecutor(Task $task, TaskResponse $response): void
    {
        DB::transaction(function () use ($task, $response) {

            $response->update([
                'status' => TaskResponseStatus::ACCEPTED,
            ]);

            $task->responses()
                ->where('id', '!=', $response->id)
                ->update([
                    'status' => TaskResponseStatus::REJECTED,
                ]);

            $task->update([
                'executor_id' => $response->executor_id,
                'status' => TaskStatus::IN_PROGRESS,
            ]);

            // todo: была проблема статус сохранялся как null (видимо из-за сериализации) пока только такой способ нашел,
            // todo: DTO в event не хочется передавать, найти способ лучше
            $response->refresh();

            event(new ExecutorSelected($task, $response));
        });
    }
}
