<?php

namespace App\Queries;
use App\Models\Task;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\User;
use http\QueryString;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;


class ExecutorTasksQuery
{
    public function get( User $user): array
    {
        return [
            'active' => $this->active($user),
            'completed' => $this->completed($user),
        ];
    }

    public function active(User $user)
    {
        return Task::where('executor_id', $user->id)->where('status', TaskStatus::IN_PROGRESS)->latest()->get();
    }

    public function completed(User $user)
    {
        return Task::where('executor_id', $user->id)->where('status', TaskStatus::COMPLETED)->latest()->get();
    }

}
