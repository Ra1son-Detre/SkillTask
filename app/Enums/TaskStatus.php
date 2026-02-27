<?php

namespace App\Enums;

enum TaskStatus: string
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
            self::IN_PROGRESS => 'В работе',
            self::AWAITING_CONFIRMATION => 'Ожидание подтверждения',
            self::COMPLETED => 'Выполнен',
            self::CANCELLED => 'Отменен',
        };


    }





}
