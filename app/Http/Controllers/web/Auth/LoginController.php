<?php

namespace App\Http\Controllers\web\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login.login-form');
    }

    public function store(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            dd('Не правильно');
        }

        $request->session()->regenerate();

        $user = User::where('email', $data['email'])->first();

        if($user['role'] === UserRole::ADMIN){
            return redirect('/adminFilament');
        }
        return redirect()->route('tasks.index');
    }
}
