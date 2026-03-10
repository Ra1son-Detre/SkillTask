<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class   AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Task::class, TaskPolicy::class);

        Gate::policy(User::class, UserPolicy::class);

        Paginator::useBootstrap();
    }
}
