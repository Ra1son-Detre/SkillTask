<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';


    public function label(): string
    {
        return match ($this) {
            self::PAID => 'Оплачен',
            self::CANCELLED => 'Отменена',
            self::FAILED => 'Ошибка',
        };
    }



}
