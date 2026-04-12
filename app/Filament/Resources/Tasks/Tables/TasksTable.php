<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->searchable(),
                TextColumn::make('client.id')
                    ->searchable()
                    ->label('Идентификатор ID'),
                TextColumn::make('executor.name')
                    ->searchable()
                    ->placeholder('Не назначен'),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Заголовок'),
                TextColumn::make('price')
                    ->numeric(decimalPlaces:2)
                    ->money('RUB', locale: 'ru')
                    ->sortable()
                    ->label('Цена задачи'),
                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->label('Статус'),
                TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата завершения')
                ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата Создания')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Дата последнего изменения'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
