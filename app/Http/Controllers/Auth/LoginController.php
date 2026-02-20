<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function show()
    {
        return view('auth.login.login-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $data = $request->validated();

        if(!Auth::attempt($data)){
            dd('Не правильно');
        };


    }

}
