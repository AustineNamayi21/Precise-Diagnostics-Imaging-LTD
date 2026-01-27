<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreImagingServiceForVisitRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'ordered_at' => ['nullable', 'date'],
            'performed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'in:ordered,performed,reported,delivered,cancelled'],
            'price_override' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
