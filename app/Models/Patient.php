<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'postal_code',
        'emergency_contact',
        'medical_history',
        'allergies',
        'is_active'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            if (empty($patient->patient_id)) {
                $patient->patient_id = 'RAD-' . str_pad(Patient::withTrashed()->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships
    public function visits()
    {
        return $this->hasMany(PatientVisit::class);
    }

    public function recentVisits()
    {
        return $this->hasMany(PatientVisit::class)->latest()->take(5);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth->age;
    }

    public function getFormattedAddressAttribute()
    {
        $parts = array_filter([$this->address, $this->city, $this->state, $this->postal_code]);
        return implode(', ', $parts);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('patient_id', 'like', "%{$search}%");
        });
    }
}