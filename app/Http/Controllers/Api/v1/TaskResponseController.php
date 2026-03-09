<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Task\TaskResponseRequest;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Services\TaskAcceptResponseService;
use App\Services\TaskResponseService;
use Illuminate\Http\Request;


class TaskResponseController extends Controller
{

    public function __construct(
        protected TaskResponseService $taskResponseService,
        protected TaskAcceptResponseService $taskAcceptResponseService
    ){}


    public function store(Task $task, TaskResponseRequest $request)
    {
        $this->authorize('respond', $task);

        $this->taskResponseService->respond($request->user(), $task, $request->validated('message'));

        return response()->json(['message' => 'Отклик оставлен!']);

    }

    public function chooseExecutor(Task $task, TaskResponse $response)
    {
        $this->authorize('choose-executor', $task);

        $this->taskAcceptResponseService->chooseExecutor($task, $response);

        return response()->json(['message' => 'Исполнитель выбран']);
    }
}
