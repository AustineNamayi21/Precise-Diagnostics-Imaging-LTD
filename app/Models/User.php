<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'specialization',
        'license_number',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

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

    public function assignedReports()
    {
        return $this->hasMany(RadiologyReport::class, 'radiologist_id');
    }

    public function conductedVisits()
    {
        return $this->hasMany(PatientVisit::class, 'radiographer_id');
    }
}