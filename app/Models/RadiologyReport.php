<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_record_id',
        'radiologist_id',
        'report_number',
        'clinical_history',
        'technique',
        'findings',
        'impression',
        'recommendations',
        'priority',
        'status',
        'finalized_at',
        'amendment_notes',
        'sent_to_patient',
        'sent_at'
    ];

    protected $casts = [
        'finalized_at' => 'datetime',
        'sent_at' => 'datetime',
        'sent_to_patient' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($report) {
            if (empty($report->report_number)) {
                $count = RadiologyReport::whereYear('created_at', now()->year)
                                         ->whereMonth('created_at', now()->month)
                                         ->count();
                $report->report_number = 'REP-' . now()->format('Y-m') . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function serviceRecord()
    {
        return $this->belongsTo(ServiceRecord::class);
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class);
    }

    public function getPatientAttribute()
    {
        return $this->serviceRecord->visit->patient ?? null;
    }

    public function scopeFinalized($query)
    {
        return $query->where('status', 'finalized');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopePendingDelivery($query)
    {
        return $query->where('status', 'finalized')
                     ->where('sent_to_patient', false);
    }

    public function scopeByRadiologist($query, $radiologistId)
    {
        return $query->where('radiologist_id', $radiologistId);
    }

    public function finalize()
    {
        $this->update([
            'status' => 'finalized',
            'finalized_at' => now(),
        ]);
    }

    public function markAsSent()
    {
        $this->update([
            'sent_to_patient' => true,
            'sent_at' => now(),
        ]);
    }

    public function isEditable()
    {
        return $this->status === 'draft';
    }
}