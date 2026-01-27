<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'visit_date' => ['required', 'date'],
            'visit_time' => ['nullable', 'date_format:H:i'],
            'visit_type' => ['required', 'in:imaging,follow_up,consult'],
            'reason_for_visit' => ['nullable', 'string'],
            'clinical_notes' => ['nullable', 'string'],
            'status' => ['required', 'in:scheduled,checked_in,in_progress,completed,cancelled'],
        ];
    }
}
