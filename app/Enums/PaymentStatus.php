<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case DEPOSIT = 'deposit';
    case TASK_PAYMENT = 'task_payment';


    public function label(): string
    {
        return match ($this) {
            self::DEPOSIT => 'пополнение',
            self::TASK_PAYMENT => 'Оплата задачи',
        };
    }



}
