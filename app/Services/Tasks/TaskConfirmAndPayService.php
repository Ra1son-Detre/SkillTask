<?php

namespace App\Services\Tasks;
use App\Enums\PaymentStatus;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Events\ClientPayAndConfirm;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskConfirmAndPayService
{
    public function confirm(Task $task, User $user)
    {
        if ($user->role !== UserRole::CLIENT) {
            throw new \DomainException('Вы не имеете права на это действие');
        }

        if ($task->status !== TaskStatus::AWAITING_CONFIRMATION) {
            throw new \DomainException('Неверный статус для выполнения операции');
        }

        $client = $task->client;
        $executor = $task->executor;

        if (!$executor) {
            throw new \DomainException('Исполнитель не назначен');
        }

        [$payer, $beneficiary] = DB::transaction(function () use ($client, $executor, $task) {

            $clientLocked = User::where('id', $client->id)->lockForUpdate()->first();

            $executorLocked = User::where('id', $executor->id)->lockForUpdate()->first();


            $clientBalance = $clientLocked->getBalance();

            if ($clientBalance < $task->price) {
                throw new \DomainException('Недостаточно средств для выполнения операции');
            }

            $payer = Transaction::create([
                'user_id' => $clientLocked->id,
                'task_id' => $task->id,
                'type' => PaymentStatus::TASK_PAYMENT,
                'amount' => -$task->price,
            ]);

            $beneficiary = Transaction::create([
                'user_id' => $executorLocked->id,
                'task_id' => $task->id,
                'type' => PaymentStatus::TASK_PAYMENT,
                'amount' => $task->price,
            ]);

            $task->update(['status' => TaskStatus::COMPLETED, 'completed_at' => now()]);

            return [$payer, $beneficiary];
        });

        event(new ClientPayAndConfirm($task, $payer, $beneficiary ));
    }
}
