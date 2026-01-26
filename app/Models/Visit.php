<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'visit_date',
        'visit_time',
        'visit_type',
        'reason_for_visit',
        'clinical_notes',
        'status',
        'created_by',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function imagingServices(): HasMany
    {
        return $this->hasMany(ImagingService::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // (Optional) if you later make an Appointment model:
    // public function appointment(): BelongsTo
    // {
    //     return $this->belongsTo(Appointment::class);
    // }
}
