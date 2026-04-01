<?php

namespace App\Events;

use App\Models\Task;
use App\Models\Transaction;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientPayAndConfirm
{
    use Dispatchable, SerializesModels;

    public function __construct(public Task $task, public Transaction $beneficiary,  public Transaction $payer)
    {
    }

}
