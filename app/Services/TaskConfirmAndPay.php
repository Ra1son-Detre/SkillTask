<?php

namespace App\Services;
namespace App\Services;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class TaskConfirmAndPay
{
    public function confirm(Task $task, User $user)
    {
    }
}
