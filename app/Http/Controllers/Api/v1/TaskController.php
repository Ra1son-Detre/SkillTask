<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Task\TaskStoreRequest;
use App\Http\Requests\Api\v1\Task\TaskUpdateRequest;
use App\Http\Resources\Api\V1\TaskResource;
use App\Models\Task;
use App\Queries\UniversalPageQuery;
use App\Services\CrudService;
use App\Services\ReportCompletionActionService;
use App\Services\TaskConfirmAndPayService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct(
        protected CrudService $crudService,
        protected TaskConfirmAndPayService $taskConfirmAndPayService,
        protected ReportCompletionActionService $reportCompletionActionService,
    ){}

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

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        if($task->client_id === request()->user()->id){
            $task->load('responses.executor');
        }

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

    public function completeTask(Task $task)
    {
        $this->authorize('complete-by-executor', $task);

        $this->reportCompletionActionService->execute($task);

        return new TaskResource($task);

    }

    public function confirmAndPay(Task $task, Request $request)
    {
        $this->authorize('confirmAndPay', $task);

        $this->taskConfirmAndPayService->confirm($task, $request->user());

        return new TaskResource($task);
    }

}
