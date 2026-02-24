<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        $user = auth()->user();
//        dd($user);
        return view('user.profile', compact('user'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function myTasksResponses()
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


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
