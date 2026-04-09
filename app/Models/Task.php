<?php

namespace App\Models;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'executor_id',
        'title',
        'description',
        'price',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'completed_at' => 'datetime',
        'status' => TaskStatus::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(TaskResponse::class, 'task_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'task_id');
    }

    public function viewResponseForm(User $user): bool
    {
        return $this->responses()->where('executor_id', $user->id)->exists();
    }

    public function viewExecutorState(User $user): ?string
    {
        if ($user->role !== UserRole::EXECUTOR) {
            return null;
        }

        if ($this->status === TaskStatus::PUBLISHED) {
            if ($this->viewResponseForm($user)) {
                return 'responded';
            }

            return 'can_respond';
        }

        if ($this->status === TaskStatus::IN_PROGRESS && $this->executor_id === $user->id) {
            return 'progress';
        }

        if ($this->status === TaskStatus::AWAITING_CONFIRMATION && $this->executor_id === $user->id) {
            return 'awaiting_confirmation';
        }

        if ($this->status === TaskStatus::COMPLETED && $this->executor_id === $user->id) {
            return 'completed';
        }

        return null;
    }
}
