<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnalyseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required'],
            'result' => ['required'],
            'created_id' => ['required','exists:users,id'],
            'patient_id' => ['required','exists:users,id'],
            'personal_id' => ['required','exists:users,id'],
        ];
    }
}
