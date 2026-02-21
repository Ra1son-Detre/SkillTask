<?php

namespace App\Enums;

enum TaskResponseStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Рассмотрение',
            self::ACCEPTED => 'Принят',
            self::REJECTED => 'Отклонен',
        };
    }

}
