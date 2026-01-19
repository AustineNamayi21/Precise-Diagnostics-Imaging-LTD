<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'service' => ['required', 'string', 'max:255'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'dob' => ['nullable', 'date', 'before:today'],
            'reason' => ['nullable', 'string', 'max:1000'],
            'insurance' => ['nullable', 'string', 'max:100'],
            'contact_whatsapp' => ['nullable', 'boolean'],
            'contact_sms' => ['nullable', 'boolean'],
            'contact_email' => ['nullable', 'boolean'],
            'terms' => ['required', 'accepted'],
        ];
    }

    public function messages()
    {
        return [
            'service.required' => 'Please select a service',
            'appointment_date.required' => 'Please select a date',
            'appointment_date.after_or_equal' => 'Appointment date must be today or in the future',
            'appointment_time.required' => 'Please select a time',
            'name.required' => 'Please enter your name',
            'phone.required' => 'Please enter your phone number',
            'terms.required' => 'You must agree to the terms and conditions',
            'terms.accepted' => 'You must agree to the terms and conditions',
        ];
    }

    protected function prepareForValidation()
    {
        $contactPreferences = [];
        if ($this->has('contact_whatsapp')) {
            $contactPreferences['whatsapp'] = true;
        }
        if ($this->has('contact_sms')) {
            $contactPreferences['sms'] = true;
        }
        if ($this->has('contact_email')) {
            $contactPreferences['email'] = true;
        }

        $this->merge([
            'contact_preferences' => $contactPreferences,
        ]);
    }
}