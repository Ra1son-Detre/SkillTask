<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'client_id',
        'executor_id',
        'title',
        'description',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    public function client() :BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function executor() :BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function responses() :HasMany
    {
        return $this->hasMany(TaskResponse::class, 'task_id');
    }

    public function transactions() :HasMany
    {
        return $this->hasMany(Transaction::class, 'task_id');
    }


}
