<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClientPayNotification extends Notification
{
    use Queueable;


    public function __construct(public Task $task)
    {

    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */



    public function toDatabase(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'client_id' => $this->task->client_id,
            'message' => 'Клиент подтвердил и оплатил задачу 💰',
        ];
    }
}
