<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes','string', 'min:3', 'max:255'],
            'last_name' => ['sometimes','string', 'min:3', 'max:255'],
            'phone' => ['sometimes'],
            'email' => ['sometimes','email'],
            'adress' => ['sometimes'],
            'role' => ['sometimes'],
        ];
    }
}
