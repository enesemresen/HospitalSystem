<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserIdentityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mother_name' => ['sometimes'],
            'father_name' => ['sometimes'],
            'serial_no' => ['sometimes'],
            'birthday' => ['sometimes'],
            'birthplace' => ['sometimes'],
            'user_id' => ['sometimes','exists:users,id'],
            'insurance_number' => ['sometimes'],
        ];
    }
}
