<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\Pages\UserTasks;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Schema;
use App\Enums\UserRole;
use Filament\Tables\Columns\ImageColumn;
use App\Models\User;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\Users\Schemas\UserForm;
class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('Индитификатор пользователя'),
                TextEntry::make('name')
                    ->label('Имя'),
                TextEntry::make('email')
                    ->label('Почта')
                    ->placeholder('-'),
                TextEntry::make('role')
                    ->badge()
                    ->label('Роль'),
                TextEntry::make('balance')
                    ->numeric(decimalPlaces:2)
                    ->getStateUsing(fn (User $record) => $record->getBalance())
                    ->money('RUB', locale: 'ru')
                    ->label('Баланс'),
                TextEntry::make('is_blocked')
                    ->label('Статус доступа')
                    ->badge()
                    ->state(fn ($record) => $record->is_blocked ? 'Заблокирован' : 'Активен')
                    ->color(fn ($record) => $record->is_blocked ? 'danger' : 'success'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Дата регистрации')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Дата последнего редактирования профиля')
                    ->placeholder('-'),
                Actions::make([
                    Action::make('openTasks')
                    ->label('Все задачи пользователя')
                        ->icon('heroicon-m-briefcase')
                        ->color('primary')
                        ->url(fn (User $record) => UserTasks::getUrl(['record' => $record]))

                ])
            ]);
    }
}
