<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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

    public function outgoingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_user_id');
    }

    public function incomingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'to_user_id');
    }
}
