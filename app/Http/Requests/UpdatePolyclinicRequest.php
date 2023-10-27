<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePolyclinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes'],
            'personal_id' => ['sometimes','exists:users,id'],
            'hospital_id' => ['sometimes','exists:hospital,id'],
        ];
    }
}
