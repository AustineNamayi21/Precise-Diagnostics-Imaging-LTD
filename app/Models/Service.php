<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category',
        'description',
        'duration_minutes',
        'price',
        'discounted_price',
        'is_active',
        'preparation_instructions',
        'post_procedure_care',
        'insurance_coverage',
        'contraindications',
        'icon_class',
        'display_order',
        'slot_buffer_minutes',
        'requires_radiologist',
        'requires_fasting',
        'advance_booking_days',
        'cancellation_hours',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'is_active' => 'boolean',
        'requires_radiologist' => 'boolean',
        'requires_fasting' => 'boolean',
        'preparation_instructions' => 'array',
        'post_procedure_care' => 'array',
        'insurance_coverage' => 'array',
        'contraindications' => 'array',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFormattedPrice()
    {
        if ($this->discounted_price && $this->discounted_price < $this->price) {
            return [
                'original' => number_format($this->price, 2),
                'discounted' => number_format($this->discounted_price, 2),
                'has_discount' => true,
            ];
        }
        
        return [
            'price' => number_format($this->price, 2),
            'has_discount' => false,
        ];
    }
}