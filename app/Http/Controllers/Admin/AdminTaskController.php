<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Queries\AdminTaskQuery;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Validation\Rules\Enum;

class AdminTaskController extends Controller
{
    public function index(AdminTaskQuery $query, Request $request)
    {
        $tasks = $query->get($request);

        return view('admin.tasks', compact('tasks'));
    }

    public function showTask(Task $task)
    {
        $task->load(['client', 'executor', 'responses']);

        return view('admin.task_show', compact('task'));
    }

    public function changeStatus(Request $request, Task $task)
    {
        $request->validate(['status' => ['required', new Enum(TaskStatus::class)],]);

        $task->update(['status' => $request->status,]);

        return back();
    }
}
