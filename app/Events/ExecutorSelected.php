<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class ExecutorSelected
{
    use Dispatchable, SerializesModels;

    public function __construct(public Task $task)
    {

    }
}
