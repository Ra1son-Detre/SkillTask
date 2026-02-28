<?php

namespace App\Listeners\ExecutorCompleted;

use App\Events\ExecutorCompletedTask;
use App\Notifications\ExecutorReportedCompletion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExecutorCompletedTaskNotification
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExecutorCompletedTask $event): void
    {
        $event->task->client->notify(new ExecutorReportedCompletion($event->task));
    }
}
