<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_date',
        'start_time',
        'end_time',
        'service_id',
        'radiologist_id',
        'slot_type',
        'max_appointments',
        'booked_count',
        'is_active',
    ];

    protected $casts = [
        'slot_date' => 'date',
        'start_time' => 'string',   // FIXED: was wrong datetime cast
        'end_time' => 'string',     // FIXED
        'is_active' => 'boolean',
        'booked_count' => 'integer',
        'max_appointments' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class, 'radiologist_id')
            ->where('user_type', 'radiologist');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_active', true)
            ->where('slot_type', 'available')
            ->where('slot_date', '>=', today())
            ->whereColumn('booked_count', '<', 'max_appointments');
    }

    public function scopeForDate($query, $date)
    {
        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        return $query->whereDate('slot_date', $date);
    }

    public function scopeForService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }
}
