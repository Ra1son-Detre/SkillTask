<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Task\TaskStoreRequest;
use App\Http\Requests\Api\v1\Task\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Queries\UniversalPageQuery;
use App\Services\CrudService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct(public CrudService $crudService){}
    public function index(Request $request, UniversalPageQuery $query)
    {

        $tasks = $query->get($request, $request->user());

        return TaskResource::collection($tasks);
    }

    public function store(TaskStoreRequest $request)
    {
       $task = $this->crudService->create($request->validated(), $request->user()->id);

        return new TaskResource($task);
    }

    public function show(Request $request, Task $task)
    {
        return  new TaskResource($task);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $this->crudService->update($task, $request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $this->crudService->delete($task);

        return response()->json(null, 204);
    }
}
