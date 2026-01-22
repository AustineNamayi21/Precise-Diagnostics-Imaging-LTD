<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_visit_id',
        'imaging_service_id',
        'radiologist_id',
        'service_date',
        'technician_notes',
        'image_files_path',
        'status'
    ];

    protected $casts = [
        'service_date' => 'datetime',
    ];

    public function visit()
    {
        return $this->belongsTo(PatientVisit::class, 'patient_visit_id');
    }

    public function service()
    {
        return $this->belongsTo(ImagingService::class, 'imaging_service_id');
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class, 'radiologist_id');
    }

    public function report()
    {
        return $this->hasOne(RadiologyReport::class);
    }

    public function getHasReportAttribute()
    {
        return $this->report()->exists();
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePendingReporting($query)
    {
        return $query->where('status', 'completed')
                     ->whereDoesntHave('report');
    }
}