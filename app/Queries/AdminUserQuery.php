<?php

namespace App\Queries;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;


class AdminUserQuery
{
public function get(Request $request)
{
    $query = User::query();
    $this->searchFilter($request, $query);
    $this->roleFilter($request, $query);
    $this->registredAt($request, $query);
    $this->banList($request, $query);
    return $query->get();
}

public function searchFilter(Request $request, $query)
{
    if($request->filled('search')){
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }
}

public function roleFilter(Request $request, $query)
{
    if ($request->role === UserRole::CLIENT->value) {
        $query->where('role', UserRole::CLIENT);
    }

    if ($request->role === UserRole::EXECUTOR->value) {
        $query->where('role', UserRole::EXECUTOR);
    }
}

public function registredAt(Request $request, $query)
{
    if ($request->date === 'asc'){
        $query->reorder('created_at', 'asc');
    }

    if ($request->date === 'desc'){
        $query->reorder('created_at', 'desc');
    }
}
public function banList(Request $request, $query)
{
    if ($request->filled('is_blocked')) {
        $query->where('is_blocked', $request->is_blocked);
    }
}

}
