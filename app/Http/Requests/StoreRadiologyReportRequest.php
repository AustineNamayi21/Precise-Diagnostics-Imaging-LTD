<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyReportRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'report_text' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // 10MB
        ];
    }
}
