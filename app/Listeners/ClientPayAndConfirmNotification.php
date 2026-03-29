<?php

namespace App\Listeners;

use App\Events\ClientPayAndConfirm;
use App\Notifications\ClientPayNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientPayAndConfirmNotification implements ShouldQueue
{
    public function handle(ClientPayAndConfirm $event): void
    {
        $event->task->executor->notify(new ClientPayNotification($event->task));
    }
}
