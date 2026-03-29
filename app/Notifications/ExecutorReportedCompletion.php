<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Notifications\Notification;

class ExecutorReportedCompletion extends Notification
{
    public function __construct(public Task $task)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'message' => 'Исполнитель сообщил о выполнении ✅',
        ];
    }
}
