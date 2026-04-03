<?php

namespace App\Http\Requests\web\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'old_password' => ['nullable', 'string', 'min:1', 'max:255', 'required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:1', 'max:255',],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
