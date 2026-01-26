<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $serviceId = $this->route('service')?->id ?? null;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:services,name,' . $serviceId],
            'modality' => ['required', 'in:XRAY,ULTRASOUND,CT,MRI'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:600'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
