<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_id',
        'imaging_service_id',
        'amount',
        'method',
        'reference',
        'paid_at',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'float',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function imagingService(): BelongsTo
    {
        return $this->belongsTo(ImagingService::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
