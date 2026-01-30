<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // You can allow empty report_text (optional notes)
            'report_text' => ['nullable', 'string', 'max:10000'],

            // File upload (your form is multipart/form-data)
            'attachment' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'], // 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'attachment.required' => 'Please upload the report file.',
            'attachment.file'     => 'The uploaded report must be a valid file.',
            'attachment.mimes'    => 'Only PDF, DOC, or DOCX files are allowed.',
            'attachment.max'      => 'The report file must not exceed 10MB.',
        ];
    }
}
