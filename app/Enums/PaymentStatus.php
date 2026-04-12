<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
enum PaymentStatus: string implements HasLabel, HasColor
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

    public function getLabel(): string
    {
        return $this->label();
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::DEPOSIT => 'info',
            self::TASK_PAYMENT => 'success',
        };
    }

}
