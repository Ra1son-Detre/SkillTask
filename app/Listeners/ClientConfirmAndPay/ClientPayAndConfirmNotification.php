<?php

namespace App\Listeners\ClientConfirmAndPay;

use App\Events\ClientPayAndConfirm;
use App\Notifications\ClientPayNotification;

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
