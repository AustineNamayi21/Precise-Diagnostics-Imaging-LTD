<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreImagingServiceForVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'status'     => ['required', 'in:ordered,scheduled,in_progress,completed,cancelled'],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Please select a service.',
            'service_id.exists'   => 'The selected service does not exist.',
            'status.required'     => 'Please select a status.',
            'status.in'           => 'Invalid status selected.',
        ];
    }
}
