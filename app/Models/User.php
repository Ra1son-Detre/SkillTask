<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'is_blocked',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function clientTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'client_id');
    }

    public function executorTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'executor_id');
    }

    public function taskResponses(): HasMany
    {
        return $this->hasMany(TaskResponse::class, 'executor_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBalance(): float
    {
        return max((float) $this->transactions()->sum('amount'), 0);
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isClient(): bool
    {
        return $this->role === UserRole::CLIENT;
    }

    public function isExecutor(): bool
    {
        return $this->role === UserRole::EXECUTOR;
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('storage/default.png');
    }
}
