<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Все задачи' => Tab::make()
                ->badge(Task::query()->count())
                ->icon('heroicon-m-list-bullet'),

            'Черновики' => Tab::make()
                ->badge(Task::query()->where('status', TaskStatus::DRAFT)->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::DRAFT))
                ->icon('heroicon-m-pencil-square'),

            'Опубликованные' => Tab::make()
                ->badgeColor('info')
                ->badge(Task::query()->where('status', TaskStatus::PUBLISHED)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::PUBLISHED))
                ->icon('heroicon-m-megaphone'),

            'В работе' => Tab::make()
                ->badgeColor('warning')
                ->badge(Task::query()->where('status', TaskStatus::IN_PROGRESS)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::IN_PROGRESS))
                ->icon('heroicon-m-arrow-path'),

            'Ожидающие оплаты' => Tab::make()
                ->badgeColor('info')
                ->badge(Task::query()->where('status', TaskStatus::AWAITING_CONFIRMATION)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::AWAITING_CONFIRMATION))
                ->icon('heroicon-m-banknotes'),

            'Выполненные' => Tab::make()
                ->badgeColor('success')
                ->badge(Task::query()->where('status', TaskStatus::COMPLETED)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::COMPLETED))
                ->icon('heroicon-m-check-badge'),

            'Отмененные' => Tab::make()
                ->badgeColor('danger')
                ->badge(Task::query()->where('status', TaskStatus::CANCELLED)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::CANCELLED))
                ->icon('heroicon-m-x-circle'),
        ];
    }
}
