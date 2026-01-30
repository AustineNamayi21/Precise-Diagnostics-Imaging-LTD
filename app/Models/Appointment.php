<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'appointment_number',
        'patient_name',
        'patient_email',
        'patient_phone',
        'patient_dob',
        'service_id',
        'service_name',
        'appointment_date',
        'appointment_time',
        'status',
        'priority',
        'notes',
    ];
}
