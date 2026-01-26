<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImagingService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'visit_id',
        'service_id',
        'ordered_at',
        'performed_at',
        'radiographer_id',
        'notes',
        'status',
        'price_override',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'performed_at' => 'datetime',
        'price_override' => 'decimal:2',
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function radiographer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'radiographer_id');
    }

    public function report(): HasOne
    {
        return $this->hasOne(RadiologyReport::class);
    }

    /**
     * Convenience: returns the effective price (override or catalog price)
     */
    public function getEffectivePriceAttribute(): float
    {
        if (!is_null($this->price_override)) {
            return (float) $this->price_override;
        }

        return (float) ($this->service?->price ?? 0);
    }
}
