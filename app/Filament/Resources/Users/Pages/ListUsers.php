<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Все пользователи' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('role', 'admin')),

            'Клиенты' => Tab::make()
                ->badge(User::query()->where('role', 'client')->count())
                ->badgeColor('secondary')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'client'))
                ->icon('heroicon-m-user-group'),

            'Исполнители' => Tab::make()
                ->badgeColor('success')
                ->badge(User::query()->where('role', 'executor')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'executor'))
            ->icon('heroicon-m-user-group'),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'Все пользователи';
    }
}
