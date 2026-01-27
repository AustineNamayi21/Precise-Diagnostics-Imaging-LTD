<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateImagingServiceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'ordered_at' => ['nullable', 'date'],
            'performed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:ordered,performed,reported,delivered,cancelled'],
            'price_override' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
