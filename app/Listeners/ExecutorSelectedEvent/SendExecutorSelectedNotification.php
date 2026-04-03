<?php

namespace App\Listeners\ExecutorSelectedEvent;

use App\Events\ExecutorSelected;
use App\Notifications\ExecutorSelectedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendExecutorSelectedNotification implements ShouldQueue
{
    public function handle(ExecutorSelected $event): void
    {
        $event->task->executor->notify(new ExecutorSelectedNotification($event->task));
    }
}
