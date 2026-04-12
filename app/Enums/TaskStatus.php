<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
enum TaskStatus: string implements HasLabel, HasColor
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case IN_PROGRESS = 'in_progress';
    case AWAITING_CONFIRMATION = 'awaiting_confirmation';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Черновик',
            self::PUBLISHED => 'Опубликована',
            self::IN_PROGRESS => 'В работе ',
            self::AWAITING_CONFIRMATION => 'Ожидание подтверждения',
            self::COMPLETED => 'Выполнен',
            self::CANCELLED => 'Отменен',
        };
    }

    public function emoji() :string
    {
        return match ($this) {
            self::DRAFT => '📝',
            self::PUBLISHED => '📢',
            self::IN_PROGRESS => '⚙️',
            self::AWAITING_CONFIRMATION => '⌛',
            self::COMPLETED => '✅',
            self::CANCELLED => '❌',
        };
    }

    public function getLabel(): ?string
    {
        // Склеиваем эмодзи и текст для красоты в Filament
        return $this->emoji() . ' ' . $this->label();
    }

    public function statusColor() :string
    {
        return match ($this) {
            self::DRAFT => 'bg-secondary',
            self::PUBLISHED => 'bg-primary',
            self::IN_PROGRESS => 'bg-warning text-dark',
            self::AWAITING_CONFIRMATION => 'bg-info text-dark',
            self::COMPLETED => 'bg-success',
            self::CANCELLED => 'bg-danger',
        };
    }

    public function getColor(): ?string
    {
        return $this->statusColor();
    }


}
