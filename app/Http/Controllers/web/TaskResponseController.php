<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\Task\TaskResponseRequest;
use App\Models\Task;
use App\Models\TaskResponse;
use App\Services\TaskAcceptResponseService;
use App\Services\TaskResponseService;

class TaskResponseController extends Controller
{
    public function __construct(
        protected TaskResponseService $taskResponseService,
        protected TaskAcceptResponseService $taskAcceptResponseService,
    ) {
    }

    public function store(Task $task, TaskResponseRequest $request)
    {
        $this->authorize('respond', $task);

        $this->taskResponseService->respond(auth()->user(), $task, $request->validated('message'));

        return back()->with('success', 'Отклик отправлен');
    }

    public function chooseExecutor(Task $task, TaskResponse $response)
    {
        $this->authorize('chooseExecutor', $task);

        $this->taskAcceptResponseService->chooseExecutor($task, $response);

        return back()->with('success', 'Исполнитель выбран');
    }
}
