<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.users', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        $user->update([
            'is_blocked' => ! $user->is_blocked
        ]);

        return redirect()->back();
    }
}
