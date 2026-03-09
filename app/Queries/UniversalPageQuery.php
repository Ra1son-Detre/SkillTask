<?php

namespace App\Queries;
use App\Models\Task;
use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
class UniversalPageQuery
{
public function get(Request $request, User $user)
{
    $query = Task::query();
    $this->userRole($query, $user);
    $this->pageStatus($query, $request->query('status'), $user);
    $this->filters($request, $query);

    return $query
        ->paginate(15)
        ->withQueryString();
}

public function userRole($query, User $user)
{
return match($user->role) {
    UserRole::CLIENT => $query->where('client_id', $user->id),

    UserRole::EXECUTOR => $query
        ->where('status', '!=', TaskStatus::DRAFT)
        ->where(function ($q) use ($user) {$q->whereNull('executor_id')->orWhere('executor_id', $user->id);
        }),

    UserRole::ADMIN => $query,
    };
}

public function pageStatus ($query, $status, User $user)
{
    if($user->role === UserRole::CLIENT){
        match ($status){
            'draft' => $query->where('status', TaskStatus::DRAFT),

            'published' => $query
                ->where('status', TaskStatus::PUBLISHED)
                ->wherenull('executor_id')
                ->withCount('responses'),

            'in_progress' => $query->where('status', TaskStatus::IN_PROGRESS),

            'awaiting_confirmation'=>$query->where('status', TaskStatus::AWAITING_CONFIRMATION),

            'completed' => $query->where('status', TaskStatus::COMPLETED),

            default => $query,
        };
    }

    if($user->role === UserRole::EXECUTOR){
        match ($status){
            'published' => $query
                ->where('status', TaskStatus::PUBLISHED)
                ->whereNull('executor_id')
                ->whereDoesntHave('responses', function ($q) use ($user){
                    $q->where('executor_id', $user->id);
                }),

            'my_response' => $query
                ->whereNull('executor_id')
                ->whereHas('responses', function ($q) use ($user) {
                    $q->where('executor_id', $user->id);
                }),

            'in_progress' => $query
                ->where('status', TaskStatus::IN_PROGRESS)
                ->where('executor_id', $user->id),

            'awaiting_confirmation' => $query
                ->where('status', TaskStatus::AWAITING_CONFIRMATION)
                ->where('executor_id', $user->id),

            'completed' => $query
                ->where('status', TaskStatus::COMPLETED)
                ->where('executor_id', $user->id),

            default => $query,
        };
    }

    return $query;
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
