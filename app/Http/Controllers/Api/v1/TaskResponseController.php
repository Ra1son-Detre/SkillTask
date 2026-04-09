<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Task\TaskResponseRequest;
use App\Http\Resources\Api\V1\TaskResponseResource;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Services\Tasks\TaskAcceptResponseService;
use App\Services\Tasks\TaskResponseService;

class TaskResponseController extends Controller
{
    public function __construct(
        protected TaskResponseService $taskResponseService,
        protected TaskAcceptResponseService $taskAcceptResponseService
    ) {}

    public function respond(Task $task, TaskResponseRequest $request)
    {
        $this->authorize('respond', $task);

        $response = $this->taskResponseService->respond($request->user(), $task, $request->validated('message'));

        $response->load('executor');

        return new TaskResponseResource($response);
    }

    public function chooseExecutor(Task $task, TaskResponse $response)
    {
        $this->authorize('choose-executor', $task);

        $this->taskAcceptResponseService->chooseExecutor($task, $response);

        return response()->json(['message' => 'Исполнитель выбран']);
    }
}
