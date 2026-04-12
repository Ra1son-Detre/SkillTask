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
                    ->label('Палтельщик задачи'),
                TextEntry::make('task.title')
                    ->label('Заголовок задачи')
                    ->placeholder('-'),
                TextEntry::make('type')
                    ->badge()
                    ->label('Тип транзакции')
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->placeholder('-'),
                TextEntry::make('amount')
                    ->numeric()
                    ->money('RUB', locale: 'ru')
                    ->label('Сумма'),
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
