<?php

namespace App\Queries;
use App\Models\Task;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;

class GetTasksQuery
{
    public function get(Request $request, User $user)
    {
        $query = Task::query();
        $this->userRole($query, $user);
        $this->filters($request, $query);

        return $query->get();

    }

//    public function userRole($query, User $user)
//    {
//        if ($user->role === UserRole::CLIENT) {
//            $query->where('client_id', $user->id);
//        }
//        if ($user->role === UserRole::EXECUTOR) {
//            $query->where('status', TaskStatus::PUBLISHED)->whereNull('executor_id');
//        }
//        if($user->role === UserRole::ADMIN) {
//
//        }
//    }

    public function userRole($query, User $user)
    {
        return match ($user->role) {
            UserRole::CLIENT => $query->where('client_id', $user->id ),
            UserRole::EXECUTOR => $query->where('status', TaskStatus::PUBLISHED)->whereNull('executor_id'),
            UserRole::ADMIN => $query,
        };
    }

    public function filters(Request $request, $query)
    {
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->price_sort === 'asc') {
            $query->orderBy('price', 'asc');
        }
        if ($request->price_sort === 'desc') {
            $query->orderBy('price', 'desc');
        }
        if ($request->date_sort === 'asc') {
            $query->orderBy('created_at', 'asc');
        }
        if ($request->date_sort === 'desc') {
            $query->orderBy('created_at', 'desc');
        }
    }
}
