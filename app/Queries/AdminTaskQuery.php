<?php

namespace App\Queries;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminTaskQuery
{
public function get(Request $request)
{
    $query = Task::query()->with('client', 'executor');
    $this->filterStatus($query, $request);
    $this->filterClient($query, $request);
    $this->filterExecutor($query, $request);
    $this->filterSearch($query, $request);
    $this->sortDate($query, $request);
    $this->sortPrice($query, $request);

    return $query->get();
}

public function filterStatus($query, Request $request)
{
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
}

public function filterClient($query, Request $request)
{
    if ($request->filled('client')) {
        $query->where('client_id', $request->client);
    }
}

public function filterExecutor($query, Request $request)
{
    if ($request->filled('executor')) {
        $query->where('executor_id', $request->executor);
    }
}

public function filterSearch($query, Request $request)
{
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
}

public function sortDate($query, Request $request)
{
    if ($request->date === 'asc'){
        $query->reorder('created_at', 'asc');
    }
    if ($request->date === 'desc'){
        $query->reorder('created_at', 'desc');
    }
}

public function sortPrice($query, Request $request)
{
    if ($request->price === 'asc'){
        $query->reorder('price', 'asc');
    }
    if ($request->price === 'desc'){
        $query->reorder('price', 'desc');
    }
}

}
