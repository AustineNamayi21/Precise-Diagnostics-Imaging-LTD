<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RadiologyReport extends Model
{
    protected $fillable = [
        'imaging_service_id',
        'report_text',
        'attachment_path',
        'attachment_name',
        'attachment_mime',
        'attachment_size',
        'status',
        'created_by',
        'finalized_by',
        'finalized_at',
    ];

    protected $casts = [
        'finalized_at' => 'datetime',
        'attachment_size' => 'integer',
    ];

    public function imagingService(): BelongsTo
    {
        return $this->belongsTo(ImagingService::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function finalizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'finalized_by');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(ReportDelivery::class);
    }

    public function isFinal(): bool
    {
        return $this->status === 'final';
    }
}
