<?php

namespace App\Filament\Resources\Users\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\Tasks\Schemas\TaskInfolist;
use App\Filament\Resources\Tasks\TaskResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Task;
use BackedEnum;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserTasks extends ManageRelatedRecords
{
    protected static string $resource = UserResource::class;

    protected static string $relationship = 'clientTasks';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

//    public function form(Schema $schema): Schema
//    {
//        return $schema
//            ->components([
//                TextInput::make('title')
//                    ->required()
//                    ->maxLength(255),
//                Textarea::make('description'),
//            ]);
//    }


    public function getTabs(): array
    {
        // Это свойство которое доуступно после extends ManageRelatedRecords, этот тот пользователь которого смотрим
        $user = $this->getOwnerRecord();

        return [
            'Все задачи' => Tab::make()
                ->badge(Task::forUser($user->id)->count())
                ->icon('heroicon-m-list-bullet'),

            'Черновики' => Tab::make()
                ->badge(Task::query()->where('status', TaskStatus::DRAFT)
                    ->forUser($user->id)
                    ->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::DRAFT))
                ->icon('heroicon-m-pencil-square'),

            'Опубликованные' => Tab::make()
                ->badgeColor('info')
                ->badge(Task::query()->where('status', TaskStatus::PUBLISHED)
                    ->forUser($user->id)
                    ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::PUBLISHED))
                ->icon('heroicon-m-megaphone'),

            'В работе' => Tab::make()
                ->badgeColor('warning')
                ->badge(Task::query()->where('status', TaskStatus::IN_PROGRESS)
                    ->forUser($user->id)
                    ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::IN_PROGRESS))
                ->icon('heroicon-m-arrow-path'),

            'Ожидающие оплаты' => Tab::make()
                ->badgeColor('info')
                ->badge(Task::query()->where('status', TaskStatus::AWAITING_CONFIRMATION)
                    ->forUser($user->id)
                    ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::AWAITING_CONFIRMATION))
                ->icon('heroicon-m-banknotes'),

            'Выполненные' => Tab::make()
                ->badgeColor('success')
                ->badge(Task::query()->where('status', TaskStatus::COMPLETED)
                    ->forUser($user->id)
                    ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::COMPLETED))
                ->icon('heroicon-m-check-badge'),

            'Отмененные' => Tab::make()
                ->badgeColor('danger')
                ->badge(Task::query()->where('status', TaskStatus::CANCELLED)
                    ->forUser($user->id)
                    ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', TaskStatus::CANCELLED))
                ->icon('heroicon-m-x-circle'),
        ];
    }
    public function infolist(Schema $schema): Schema
    {
        return TaskInfolist::configure($schema);
    }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
//                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
