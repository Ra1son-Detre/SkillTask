<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskResponseRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaskResponse;
use App\Services\TaskResponseService;
class TaskResponseController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {

    }

    public function store(Task $task, TaskResponseService $service, TaskResponseRequest $request)
    {
        $this->authorize('response', $task);
        $service->respond(auth()->user(), $task, $request->validated('message'));

        return back()->with('success', 'Отклик отправлен');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
