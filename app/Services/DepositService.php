<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepositService
{
    public function deposit(User $user, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Сумма не может быть отрицательной или равна 0');
        }

        DB::transaction(function () use ($user, $amount) {
            $lockedUser = User::where('id', $user->id)->lockForUpdate()->first();

            Transaction::create([
                'user_id' => $lockedUser->id,
                'type' => PaymentStatus::DEPOSIT,
                'amount' => $amount,
            ]);
        });
    }
}
