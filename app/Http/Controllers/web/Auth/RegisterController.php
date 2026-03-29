<?php

namespace App\Http\Controllers\web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\Auth\RegisterRequest;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $roles = UserRole::registrationRoles();

        return view('auth.register.register-form', compact('roles'));
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('tasks.index');
    }
}
