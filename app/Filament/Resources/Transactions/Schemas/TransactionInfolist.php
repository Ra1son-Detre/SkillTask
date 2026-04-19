<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Пользователь'),
                TextEntry::make('task.client.name')
                    ->label('Палтельщик задачи')
                ->visible(fn ($record) => filled($record->task_id)),
                TextEntry::make('task.title')
                    ->label('Заголовок задачи')
                    ->placeholder('-')
                    ->visible(fn ($record) => filled($record->task_id)),
                TextEntry::make('type')
                    ->badge()
                    ->label('Тип транзакции')
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->placeholder('-'),
                TextEntry::make('amount')
                    ->numeric()
                    ->money('RUB', locale: 'ru')
                    ->label('Сумма')
                    ->prefix(fn ($state) => $state > 0 ? '+' : ''),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Дата создания транзакции')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Дата успешности транзакции')
                    ->placeholder('-'),
            ]);
    }
}
