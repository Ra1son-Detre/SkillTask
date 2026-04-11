<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                ->label('Имя'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->label('Электронная почта'),
                TextColumn::make('role')
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->label('Роль'),
                TextColumn::make('avatar')
                    ->searchable()->placeholder('Default avatar')
                    ->label('Аватарка'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата регистрации'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата редактирования профиля')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_blocked')
                    ->boolean()
                    ->label('Заблокирован'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
