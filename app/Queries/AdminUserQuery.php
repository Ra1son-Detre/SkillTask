<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class AdminUserQuery
{
    public function get(Request $request)
    {
        return QueryBuilder::for(User::class)

            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('name', 'like', '%' . $value . '%')
                            ->orWhere('email', 'like', '%' . $value . '%');
                    });
                }),

                AllowedFilter::exact('role'), // exact - строгое совпадене
                AllowedFilter::exact('is_blocked'),
            ])

            ->allowedSorts([
                'created_at',
            ])

            ->defaultSort('-created_at')
            ->paginate(15)
            ->withQueryString();
    }
}
