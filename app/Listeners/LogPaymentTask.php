<?php

namespace App\Listeners;

use App\Events\ClientPayAndConfirm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogPaymentTask implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(ClientPayAndConfirm $event): void
    {
        Log::channel('users_activity')->info('Task created', [

            'task_info' => [
                'id' => $event->task->id,
                'title' => $event->task->title,
                'price' => $event->task->price,
                'status' => $event->task->status->label()
            ],
            'payer' => [
                'transaction_id' => $event->payer->id,
                'id' => $event->payer->user_id,
                'type' => $event->payer->type->label(),
                'amount' =>  $event->payer->amount,
                'created_at' => $event->payer->created_at,
            ],
            'beneficiary' => [
                'transaction_id' => $event->beneficiary->id,
                'id' => $event->beneficiary->user_id,
                'type' => $event->beneficiary->type->label(),
                'amount' =>  $event->beneficiary->amount,
                'created_at' => $event->beneficiary->created_at,
            ],
        ]);
    }
}
