<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            'role' => ['required', Rule::in(array_map(fn($r) => $r->value, UserRole::forRegistration()))],
        ];
    }
}
