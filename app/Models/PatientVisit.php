<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_date',
        'visit_time',
        'visit_type',
        'reason_for_visit',
        'radiographer_id',
        'clinical_notes',
        'total_amount',
        'payment_status',
        'status'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'total_amount' => 'decimal:2',
        'visit_time' => 'datetime:H:i',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function radiographer()
    {
        return $this->belongsTo(User::class, 'radiographer_id');
    }

    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }

    public function reports()
    {
        return $this->hasManyThrough(RadiologyReport::class, ServiceRecord::class);
    }

    public function getVisitDateTimeAttribute()
    {
        return $this->visit_date->format('Y-m-d') . ' ' . $this->visit_time;
    }

    public function getFormattedVisitDateAttribute()
    {
        return $this->visit_date->format('F d, Y');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('visit_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('visit_date', '>=', today())
                     ->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function calculateTotalAmount()
    {
        $total = $this->serviceRecords->sum(function ($record) {
            return $record->service->price ?? 0;
        });
        
        $this->update(['total_amount' => $total]);
        return $total;
    }
}