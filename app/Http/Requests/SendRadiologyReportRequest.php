<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SendRadiologyReportRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email'],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
