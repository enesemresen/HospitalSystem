<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePolyclinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'personal_id' => ['required','exists:users,id'],
            'hospital_id' => ['required','exists:hospitals,id'],
        ];
    }
}
