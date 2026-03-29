<?php

namespace App\Enums;

enum UserRole: string
{
    case CLIENT = 'client';
    case EXECUTOR = 'executor';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::CLIENT => 'Клиент',
            self::EXECUTOR => 'Исполнитель',
            self::ADMIN => 'Админ',
        };
    }

    public static function registrationRoles(): array
    {
        return [
            self::CLIENT,
            self::EXECUTOR
        ];
    }
}
