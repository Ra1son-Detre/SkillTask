<?php

namespace App\Listeners\ExecutorSelected;

use App\Events\ExecutorSelected;
use App\Notifications\ExecutorSelectedNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendExecutorSelectedNotification
{
    use InteractsWithSockets;
    public function __construct()
    {
        //
    }


    public function handle(ExecutorSelected $event): void
    {
        $event->task->executor->notify(new ExecutorSelectedNotification($event->task));
    }
}
