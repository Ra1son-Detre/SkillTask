<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        if(!Auth::attempt($data)){
            dd('Не правильно');
        };

        $request->session()->regenerate();

        return redirect(route('tasks.index'));
    }
}
