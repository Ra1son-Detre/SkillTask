<?php

namespace App\Listeners;

use App\Events\ExecutorCompletedTask;
use App\Notifications\ExecutorReportedCompletionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExecutorCompletedTaskNotification implements ShouldQueue
{
    public function handle(ExecutorCompletedTask $event): void
    {
        $event->task->client->notify(new ExecutorReportedCompletionNotification($event->task));
    }
}
