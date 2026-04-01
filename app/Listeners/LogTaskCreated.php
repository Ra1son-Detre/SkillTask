<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogTaskCreated implements ShouldQueue
{

    public function handle(TaskCreated $event): void
    {
        Log::channel('users_activity')->info('Task created', [
            'task_id' => $event->task->id,
            'client_id' => $event->task->client_id,
            'title' => $event->task->title,
            'description' => $event->task->description,
            'price' => $event->task->price,
            'status' => $event->task->status->label(),
            'created_at' => $event->task->created_at,

        ]);
    }
}
