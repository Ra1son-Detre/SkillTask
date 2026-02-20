<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskResponse extends Model
{
    protected $fillable = [
        'message',
        'status',
        'executor_id',
        'task_id',
    ];

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function executor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }
}
