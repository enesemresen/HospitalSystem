<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['sometimes'],
            'time' => ['sometimes'],
            'status' => ['sometimes'],
            'patient_id' => ['sometimes','exists:appointments,id'],
            'personal_id' => ['sometimes','exists:users,id'],
        ];
    }
}
