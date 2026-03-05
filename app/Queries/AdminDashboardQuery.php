<?php

namespace App\Queries;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;

class AdminDashboardQuery
{
    public function globalInfo ()
    {
        return [
            'usersCount' => User::count(),
            'tasksCount' => Task::where('status', '!=', TaskStatus::DRAFT)->count(),
            'blockedUsers' => User::where('is_blocked', true)->count(),
            'openTasks' => Task::where('status', TaskStatus::PUBLISHED)->count(),
            'inProgressTasks' => Task::where('status', TaskStatus::IN_PROGRESS)->count(),
            'completedTasks' => Task::where('status', TaskStatus::COMPLETED)->count(),
            ];
    }
}
