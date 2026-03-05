<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Queries\AdminUserQuery;


class AdminUserController extends Controller
{
    public function index(AdminUserQuery $query, Request $request)
    {
        $users = $query->get($request);

        return view('admin.users', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        $user->update([
            'is_blocked' => ! $user->is_blocked
        ]);

        return redirect()->back();
    }

    public function showUserInfo (User $user)
    {
        $tasks = Task::where('client_id', $user->id)->orWhere('executor_id', $user->id)->get();

        return view('admin.user_show', compact('user', 'tasks'));
    }
}
