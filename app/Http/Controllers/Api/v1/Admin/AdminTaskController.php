<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\TaskStatus;
use App\Http\Resources\Api\V1\Admin\AdminTaskResource;
use Illuminate\Validation\Rules\Enum;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Queries\AdminTaskQuery;
use App\Http\Resources\Api\V1\Admin\AdminTasksResource;

class AdminTaskController extends Controller
{
    public function index(AdminTaskQuery $query, Request $request)
    {
       $tasks =  $query->get($request)->load('client', 'executor');

       return AdminTasksResource::collection($tasks);
    }

    public function show(Task $task)
    {
        return new AdminTaskResource($task);
    }

    public function changeStatus(Task $task, Request $request)
    {
        $request->validate(['status' => ['required', new Enum(TaskStatus::class)],]);

        $task->update(['status' => $request->status]);

        return response()->json('Статус успешно изменен');
    }
}
