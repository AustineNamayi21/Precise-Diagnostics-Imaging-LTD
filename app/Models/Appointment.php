<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'appointment_number',
        'patient_id',
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
        'reason',
        'insurance_provider',
        'contact_preferences',
        'estimated_cost',
        'discount_amount',
        'final_cost',
        'notes',
        'cancellation_reason',
        'confirmed_at',
        'completed_at',
        'cancelled_at',
        'confirmed_by',
        'radiologist_id',
        'room_assigned',
        'duration_minutes',
        'referral_source',
        'referring_doctor',
        'is_walkin',
        'has_previous_records',
        'attachments',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'patient_dob' => 'date',
        'contact_preferences' => 'array',
        'attachments' => 'array',
        'estimated_cost' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'is_walkin' => 'boolean',
        'has_previous_records' => 'boolean',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class, 'radiologist_id');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('appointment_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('appointment_date', '>=', today())
                    ->whereNotIn('status', ['cancelled', 'completed']);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function generateAppointmentNumber()
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return "APT-{$date}-" . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function calculateEstimatedCost()
    {
        $servicePrice = $this->service->discounted_price ?? $this->service->price;
        $this->estimated_cost = $servicePrice;
        
        if ($this->insurance_provider) {
            $insuranceCoverage = $this->getInsuranceCoverage();
            if ($insuranceCoverage > 0) {
                $discount = ($servicePrice * $insuranceCoverage) / 100;
                $this->estimated_cost = $servicePrice - $discount;
            }
        }
        
        return $this->estimated_cost;
    }

    protected function getInsuranceCoverage()
    {
        $coverages = [
            'nhif' => 80,
            'jubilee' => 90,
            'apa' => 85,
            'aar' => 75,
        ];
        
        return $coverages[strtolower($this->insurance_provider)] ?? 0;
    }
}