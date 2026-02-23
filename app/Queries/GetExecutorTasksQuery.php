<?php

namespace App\Queries;
use App\Enums\TaskStatus;
use App\Models\Task;
use http\QueryString;
use Illuminate\Http\Request;

class GetExecutorTasksQuery
{
    public function test(Request $request)
    {
        $query = Task::query()->where('status', TaskStatus::PUBLISHED)->whereNull('executor_id');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        };

        if ($request->filled('min_price')) {
            $query->where('price', ">=", $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', "<=", $request->max_price);
        }

        return $query->get();
    }
}
