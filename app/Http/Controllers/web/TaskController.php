<?php

namespace App\Http\Controllers\web;

use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\Task\TaskStoreRequest;
use App\Http\Requests\web\Task\TaskUpdateRequest;
use App\Models\Task;
use App\Queries\UniversalPageQuery;
use App\Services\CancelledTaskService;
use App\Services\ReportCompletionActionService;
use App\Services\TaskConfirmAndPayService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected ReportCompletionActionService $reportCompletionActionService,
        protected TaskConfirmAndPayService $taskConfirmAndPayService,
        protected CancelledTaskService $cancelledTaskService,
    ) {
    }

    public function index(UniversalPageQuery $query, Request $request)
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

        $user = auth()->user();

        $task->load([
            'responses.executor',
        ]);

        $notificationId = request()->query('notification');

        if ($notificationId) {
            $notification = $user->unreadNotifications()->find($notificationId);

            if ($notification) {
                $notification->markAsRead();
            }
        }

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

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Задача удалена');
    }

    public function publish(Task $task)
    {
        $this->authorize('publish', $task);

        $task->update(['status' => TaskStatus::PUBLISHED,]);

        return back();
    }

    public function cancel(Task $task)
    {
        $this->authorize('cancel', $task);

        $this->cancelledTaskService->cancel($task);

        return back();
    }

    public function draft(Task $task)
    {
        $this->authorize('draft', $task);

        $task->update(['status' => TaskStatus::DRAFT,]);

        return back();
    }

    public function reportCompletion(Task $task)
    {
        $this->reportCompletionActionService->execute($task);

        return back()->with('success', 'Клиент уведомлен');
    }

    public function confirmAndPay(Task $task)
    {
        $this->authorize('confirmAndPay', $task);

        $this->taskConfirmAndPayService->confirm($task, auth()->user());

        return redirect()->route('tasks.show', $task);
    }
}
