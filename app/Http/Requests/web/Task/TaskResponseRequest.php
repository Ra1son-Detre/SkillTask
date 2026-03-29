<?php

namespace App\Http\Requests\web\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskResponseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required|string|min:3|max:150',
        ];
    }
}
