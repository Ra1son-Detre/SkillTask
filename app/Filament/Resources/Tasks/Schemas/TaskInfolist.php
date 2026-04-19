<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('id')
                ->label('ID Задачи:')
                ->color('warning'),
            TextEntry::make('client.id')
                ->label('ID Владелеца задачи:')
                ->color('warning'),
            TextEntry::make('status')
                ->label('Статус:')
                ->color('warning'),
            TextEntry::make('title')
                ->label('Заголовок:')
                ->color('warning'),
            TextEntry::make('description')
                ->label('Описание:')
                ->color('warning'),
            TextEntry::make('price')
                ->label('Сумма вознагрождения:')
                ->money('RUB', locale: 'ru')
                ->color('warning'),
            TextEntry::make('status')
                ->label('Статус:')
                ->badge(),
            TextEntry::make('created_at')
                ->label('Дата создания:')
                ->color('warning'),
            TextEntry::make('updated_at')
                ->label('Дата последнего изменения:')
                ->color('warning'),
        ]);
    }
}
