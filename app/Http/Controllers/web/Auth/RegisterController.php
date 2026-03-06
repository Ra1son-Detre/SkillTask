<?php

namespace App\Http\Controllers\web\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function create()
    {
        $roles = UserRole::forRegistration();
        return view('auth.register.register-form', compact('roles'));
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

}
