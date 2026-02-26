<?php

namespace App\Policies;

use App\Enums\TaskStatus;
use Illuminate\Auth\Access\Response;
use App\Models\Task;
use App\Models\User;
use App\Enums\UserRole;

class TaskPolicy
{

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->client_id || $user->role === UserRole::ADMIN ||$user->role === UserRole::EXECUTOR;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::CLIENT;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::DRAFT;
    }

    public function delete(User $user, Task $task): bool
    {
        return ($user->id === $task->client_id || $user->role === UserRole::ADMIN) && $task->executor_id === null;
    }

    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::DRAFT || $user->role === UserRole::ADMIN;
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->client_id || $user->role === UserRole::ADMIN;
    }

    public function publish(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::DRAFT;
    }

    public function draft(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::PUBLISHED;
    }

    public function respond(User $user, Task $task): bool
    {
        return $user->role === UserRole::EXECUTOR && $task->status === TaskStatus::PUBLISHED && $task->executor_id === null && !$task->responses()->where('executor_id', $user->id)->exists();
    }

    public function chooseExecutor(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::PUBLISHED && $task->executor_id === null;
    }

}
