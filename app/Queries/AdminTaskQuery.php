<?php

namespace App\Queries;

use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class AdminTaskQuery
{
    public function get(Request $request)
    {
        return QueryBuilder::for(Task::class)
            ->with(['client', 'executor'])

            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::exact('client_id'),
                AllowedFilter::exact('executor_id'),
                AllowedFilter::partial('title'),
            ])

            ->allowedSorts([
                'price',
                'created_at',
                AllowedSort::field('date', 'created_at'),
            ])

            ->defaultSort('-created_at')
            ->paginate(15)
            ->withQueryString();
    }
}


