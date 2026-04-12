<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Enums\PaymentStatus;
use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
Use App\Models\Transaction;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Все транзакции' => Tab::make()
                ->badge(Transaction::query()->count())
                ->icon('heroicon-m-rectangle-stack'),

            'Пополнение баланса' => Tab::make()
                ->badge(Transaction::query()->where('type', PaymentStatus::DEPOSIT)->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', PaymentStatus::DEPOSIT))
                ->icon('heroicon-m-plus-circle'),

            'Оплата выполненной задачи' => Tab::make()
                ->label('Списание (Оплата)')
                ->badge(Transaction::query()
                    ->where('amount', '<', 0)
                    ->where('type', PaymentStatus::TASK_PAYMENT)
                    ->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('amount', '<', 0)
                    ->where('type', PaymentStatus::TASK_PAYMENT))
                ->icon('heroicon-m-minus-circle'),

            'Начисление за выполнение задачи' => Tab::make()
                ->label('Доход (Выполнение)')
                ->badge(Transaction::query()
                    ->where('amount', '>', 0)
                    ->where('type', PaymentStatus::TASK_PAYMENT)
                    ->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('amount', '>', 0)
                    ->where('type', PaymentStatus::TASK_PAYMENT))
                ->icon('heroicon-m-currency-dollar'),
        ];
    }
}
