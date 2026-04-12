<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserRole;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use App\Models\User;

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
                    ->label('Роль'),
                TextColumn::make('balance')
                    ->placeholder('-')
                    ->getStateUsing(fn (User $record) => $record->getBalance())
                    ->money('RUB', locale: 'ru')
                    ->label('Баланс'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата регистрации'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Дата редактирования профиля')
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_blocked')
                    ->disabled(fn (User $record) => auth()->user()->role !== UserRole::ADMIN)
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
