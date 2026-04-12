<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Enums\TaskStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->disabled()
                ->label('Клиент'),
                Select::make('executor_id')
                    ->relationship('executor', 'name')
                    ->default(null)
                    ->disabled()
                    ->label('Исполнитель'),
                TextInput::make('title')
                    ->required()
                    ->disabled()
                    ->label('Заголовок'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->disabled()
                    ->label('Описание'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->disabled()
                    ->label('Цена'),
                Select::make('status')
                    ->options(TaskStatus::class)
                    ->required()
                    ->label('Статус'),
                DateTimePicker::make('completed_at')
                    ->disabled()
                    ->label('Дата выполнения'),
            ]);
    }
}
