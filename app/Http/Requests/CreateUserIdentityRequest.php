<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserIdentityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tc_no' => ['required'],
            'mother_name' => ['required'],
            'father_name' => ['required'],
            'serial_no' => ['required'],
            'birthday' => ['required'],
            'birthplace' => ['required'],
            'user_id' => ['required','exists:users,id'],
            'insurance_number' => ['required'],
        ];
    }
}
