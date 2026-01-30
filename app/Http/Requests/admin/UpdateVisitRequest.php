<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_date' => ['required', 'date'],
            'status'     => ['required', 'in:scheduled,checked_in,completed,cancelled,no_show'],
            'notes'      => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'patient_id.required' => 'Please select a patient.',
            'patient_id.exists'   => 'The selected patient does not exist.',
            'visit_date.required' => 'Visit date is required.',
            'status.required'     => 'Visit status is required.',
            'status.in'           => 'Invalid visit status selected.',
        ];
    }
}
