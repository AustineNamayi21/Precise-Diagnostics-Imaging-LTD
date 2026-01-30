<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Admin routes are already protected by auth middleware
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_date' => ['required', 'date'],
            'status'     => ['required', 'in:scheduled,checked_in,completed,cancelled,no_show'],
            'notes'      => ['nullable', 'string', 'max:2000'],
        ];
    }

    /**
     * Custom validation messages (optional but nice UX)
     */
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
