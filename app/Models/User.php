<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * ONLY columns that actually exist in the database
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // REMOVED: 'role', 'phone', 'specialization', 'license_number', 'is_active'
        // Add these back later when columns exist
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // REMOVED: 'is_active' => 'boolean'
        ];
    }

    /**
     * REMOVE THESE METHODS for now since 'role' column doesn't exist
     */
    /*
    public function isRadiographer()
    {
        return $this->role === 'radiographer';
    }

    public function isRadiologist()
    {
        return $this->role === 'radiologist';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    */

    /**
     * REMOVE THESE RELATIONSHIPS for now if they depend on role-based IDs
     */
    /*
    public function assignedReports()
    {
        return $this->hasMany(RadiologyReport::class, 'radiologist_id');
    }

    public function conductedVisits()
    {
        return $this->hasMany(PatientVisit::class, 'radiographer_id');
    }
    */
}