<?php

namespace App\Http\Requests\Api\v1\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
