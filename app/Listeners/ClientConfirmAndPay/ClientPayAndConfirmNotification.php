<?php

namespace App\Listeners\ClientConfirmAndPay;

use App\Events\ClientPayAndConfirm;
use App\Models\Task;
use App\Notifications\ClientPayNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClientPayAndConfirmNotification
{

    public function __construct()
    {

    }


    public function handle(ClientPayAndConfirm $event): void
    {
        $event->task->executor->notify(new ClientPayNotification($event->task));
    }
}
