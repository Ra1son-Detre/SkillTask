<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BalanceService
{
    public function deposit(User $user, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Сумма не может быть отрицательной');
        }

        DB::transaction(function () use ($user, $amount) {
            $lockedUser = User::where('id', $user->id)
                ->lockForUpdate()
                ->first();

            Transaction::create([
                'user_id' => $lockedUser->id,
                'type' => 'deposit',
                'amount' => $amount,
            ]);
        });
    }
}
