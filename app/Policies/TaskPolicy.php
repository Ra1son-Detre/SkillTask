<?php

namespace App\Policies;

use App\Enums\TaskStatus;
use Illuminate\Auth\Access\Response;
use App\Models\Task;
use App\Models\User;
use App\Enums\UserRole;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->client_id || $user->role === UserRole::ADMIN ||$user->role === UserRole::EXECUTOR;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRole::CLIENT;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::DRAFT;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->client_id || $user->role === UserRole::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->client_id && $task->status === TaskStatus::DRAFT || $user->role === UserRole::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
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

}
