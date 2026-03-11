<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\User\ProfileEditRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ){}

    public function show()
    {
        $user = auth()->user();
        $tasks = $user->get();
        $notifications = $user->unreadNotifications;



        return view('user.profile', compact('user', 'notifications', 'tasks'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function myTasksResponses() // todo "Устаревший метод убрать или изменить не нарушая работу"
    {
        $user = auth()->user();
        $tasks = $user->clientTasks()->whereHas('responses')
            ->with(['responses.executor'])
            ->get();

        return view('user.my-tasks-responses', compact('tasks'));
    }
    public function edit(string $id)
    {
        //
    }


    public function update(ProfileEditRequest $request)
    {
        $data = $request->validated();
    }

}
