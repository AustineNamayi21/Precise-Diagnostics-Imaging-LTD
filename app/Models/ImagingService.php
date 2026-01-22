<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_code',
        'name',
        'description',
        'modality',
        'body_part',
        'price',
        'duration_minutes',
        'preparation_instructions',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecord::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByModality($query, $modality)
    {
        return $query->where('modality', $modality);
    }

    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price, 2);
    }
}