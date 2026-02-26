<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\TaskResponse;
use App\Queries\ExecutorTasksQuery;
use App\Queries\GetTasksQuery;
use App\Services\TaskAcceptResponseService;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Services\TaskResponseService;

class TaskController extends Controller
{
    public function index(GetTasksQuery $query, Request $request)
    {
        $tasks = $query->get($request, auth()->user());

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        return view('tasks.create');
    }
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();
        $data['status'] = TaskStatus::DRAFT;
        $task = $request->user()->clientTasks()->create($data);

        return redirect()->route('tasks.index', $task);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        $task->load(['responses.executor']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function publish(Task $task)
    {
        $this->authorize('publish', $task);
        $task->update(['status' => TaskStatus::PUBLISHED]);
        return back();
    }

    public function draft(Task $task)
    {
        $this->authorize('draft', $task);
        $task->update(['status' => TaskStatus::DRAFT]);
        return back();
    }

}
