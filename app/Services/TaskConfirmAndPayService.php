<?php

namespace App\Services;
use App\Enums\PaymentStatus;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Events\ClientPayAndConfirm;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class TaskConfirmAndPayService
{
    public function confirm(Task $task, User $user)
    {

        DB::transaction(function () use ($task, $user) {
            if($user->role !== UserRole::CLIENT) {
                throw new \DomainException('Вы не имеете права на это действие');
            }
            if($task->status !== TaskStatus::AWAITING_CONFIRMATION){
                throw new \DomainException('Неверный статус для выполнения операции');
            }

            $client = $task->client;
            $executor = $task->executor;

            if($client->balance < $task->price){
                throw new \DomainException('Недостаточно средств для выполнения операции');
            }

            $client->decrement('balance', $task->price);
            $executor->increment('balance', $task->price);

            Transaction::create([
                'from_user_id' => $client->id,
                'to_user_id' => $executor->id,
                'task_id' => $task->id,
                'type' => PaymentStatus::PAID,
                'amount' => $task->price,
            ]);

            $task->update(['status' => TaskStatus::COMPLETED]);
            event(new ClientPayAndConfirm($task));
        });
    }
}
