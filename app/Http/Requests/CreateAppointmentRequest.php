<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'time' => ['required'],
            'status' => ['required'],
            'patient_id' => ['required','exists:users,id'],
            'personal_id' => ['required','exists:users,id'],
        ];
    }
}
