<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Хешируем пароль
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->label(),
            ],
            'token' => $token,
        ], 201);
    }
}
