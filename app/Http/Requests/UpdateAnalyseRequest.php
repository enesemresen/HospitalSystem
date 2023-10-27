<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnalyseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['sometimes'],
            'result' => ['sometimes'],
            'created_id' => ['sometimes','exists:users,id'],
            'patient_id' => ['sometimes','exists:users,id'],
            'personal_id' => ['sometimes','exists:users,id'],
        ];
    }
}
