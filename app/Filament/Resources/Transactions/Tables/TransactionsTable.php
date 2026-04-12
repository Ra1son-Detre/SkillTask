<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->label('Имя пользователя'),
                TextColumn::make('task.id')
                    ->searchable()
                    ->label('ID Задачи')
                ->placeholder('-'),
                TextColumn::make('type')
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->label('Тип транзакции'),
                TextColumn::make('amount')
                    ->numeric()
                    ->money('RUB', locale: 'ru')
                    ->sortable()
                    ->label('Сумма'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата проведения')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата успешности')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
