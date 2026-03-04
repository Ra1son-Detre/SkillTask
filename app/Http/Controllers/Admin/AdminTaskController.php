<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Validation\Rules\Enum;

class AdminTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['client', 'executor'])->get();

        return view('admin.tasks', compact('tasks'));
    }

    public function changeStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => ['required', new Enum(TaskStatus::class)],
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return back();
    }
}
