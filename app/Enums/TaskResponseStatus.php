<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
enum TaskResponseStatus: string implements HasColor, HasLabel
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

    public function statusColor() :string
    {
        return match ($this) {
            self::PENDING => 'info',
            self::ACCEPTED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function emoji() :string
    {
        return match ($this) {
            self::PENDING =>'👀',
            self::ACCEPTED =>'✅',
            self::REJECTED =>'❌',
        };
    }

    public function getColor() : string
    {
        return $this->statusColor();
    }

    public function getLabel() : string
    {
        return $this->label();
    }

}
