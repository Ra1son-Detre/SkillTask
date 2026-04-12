<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor
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

    public function color(): string
    {
        return match ($this) {
            self::CLIENT => 'info',
            self::EXECUTOR => 'warning ',
            self::ADMIN => 'danger',
        };
    }

    public static function registrationRoles(): array
    {
        return [
            self::CLIENT,
            self::EXECUTOR
        ];
    }

    public  function getColor(): string
    {
        return $this->color();
    }

    public  function getLabel(): string
    {
        return $this->label();
    }
}
