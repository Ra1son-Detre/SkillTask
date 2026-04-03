<?php

namespace App\Listeners\ExecutorSelectedEvent;

use App\Events\ExecutorSelected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogChoiceExecutor implements ShouldQueue
{
    public function handle(ExecutorSelected $event): void
    {
        Log::channel('users_activity')->info('Choice executor', [
            'executor_id' => $event->task->executor_id,
            'client_id' => $event->task->client_id,
            'response_status' => $event->response->status->label(),
            'executor_message' => $event->response->message,
            'pending_at' => $event->response->created_at,
            'info_text1' => "Исполнитель выбран успешно",
        ]);
    }
}
